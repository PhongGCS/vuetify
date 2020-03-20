<?php
/**
 * Plugin Name: CookiePro CCPA
 * Plugin URI: http://www.onetrust.com/
 * Version: 1.0.3
 * Author: OneTrust, Llc
 * Author URI: https://www.onetrust.com/products/cookies/
 * Description: CookiePro is the most mature and trusted cookie consent tool that is purpose-built for compliance with CCPA, GDPR, ePrivacy, and IAB framework. This plug-in gives the ability to easily add a Do Not Sell button or link to your website.
 * License: GPL2
 *
 * @package CookieProCCPA
 */

/*
	Copyright 2018 OneTrust

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( ! defined( 'ABSPATH' ) && ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}
/**
 * CookiePro
 */
class CookieproCCPA {
	/**
	 * Defined as public variable
	 *
	 * @var array $banner_settings_constant is array variable.
	 */
	public $banner_settings_constant;

	/**
	 * Defined as public variable
	 *
	 * @var array $banner_settings is array variable.
	 */
	public $banner_settings;

	/**
	 * Constructor
	 */
	public function __construct() {
		// Initializes values.
		$this->plugin              = new stdClass();
		$this->plugin->name        = 'cookiepro-ccpa';
		$this->plugin->slug        = 'cookieproCCPA';
		$this->plugin->displayName = 'CookiePro CCPA';
		$this->plugin->folder      = plugin_dir_path( __FILE__ );
		$this->plugin->url         = plugin_dir_url( __FILE__ );

		// Check if the global wpb_feed_append variable exists. If not, set it.
		if ( ! array_key_exists( 'wpb_feed_append', $GLOBALS ) ) {
					$GLOBALS['wpb_feed_append'] = false;
		}
		add_action( 'admin_menu', array( &$this, 'add_setting_menu' ) );
		add_action( 'wp_footer', array( &$this, 'inject_banner' ) );

		add_action( 'wp_enqueue_scripts', array( &$this, 'ot_ccpa_plugin_scripts' ) );
		add_filter( 'plugin_action_links', array( &$this, 'ot_settings_add_action_plugin' ), 10, 5 );
	}

	/** Display popup in front end */
	public function inject_banner() {
		$this->banner_settings   = get_option( 'cookieproCCPASettings' );
		$this->behavior_settings = get_option( 'cookieproCCPABehaviorSettings' );
		$this->floatingdata      = get_option( 'CookieProCCPAButtonFloatings' );
		if( ! empty( $this->floatingdata ) ){
			$this->linkenable    = $this->floatingdata;
		} else {
			$this->linkenable    = $this->banner_settings;
		}
		include_once WP_PLUGIN_DIR . '/' . $this->plugin->name . '/assets/html/banner.php';
	}

	/**
	 * Include the jquery file in header
	 */
	public function ot_ccpa_plugin_scripts() {
		wp_enqueue_script( 'jquery' );
	}

	/** Frontendheader functions. */
	public function add_setting_menu() {
		add_menu_page( $this->plugin->displayName, $this->plugin->displayName, 'manage_options', $this->plugin->slug, array( &$this, 'ccpa_banner_configuration' ), '', 80 );
	}

	/**
	 * Added the links in plugin page
	 *
	 * @param array  $actions - plugin default actions need merge.
	 * @param string $plugin_file - plugin file path.
	 */
	public function ot_settings_add_action_plugin( $actions, $plugin_file ) {
		static $plugin;
		if ( ! isset( $plugin ) ) {
			$plugin = plugin_basename( __FILE__ );
		}
		if ( $plugin === $plugin_file ) {
				$settings  = array( 'settings' => '<a href="admin.php?page=cookieproCCPA">' . __( 'Settings', 'General' ) . '</a>' );
				$site_link = array( 'buy' => '<a href="https://www.cookiepro.com/pricing/?referral=WORDPRESS" target="_blank">Buy CookiePro</a>' );
				$actions   = array_merge( $settings, $actions );
				$actions   = array_merge( $actions, $site_link );
		}
			return $actions;
	}

	/** Call back function when we click on menu in admin side */
	public function ccpa_banner_configuration() {

		if ( ! current_user_can( 'manage_options' ) ) {
			echo esc_html( 'You do not have sufficient permissions to access this page.' );
			return;
		}

		$this->save_banner_settings();
		$this->save_banner_behavior_settings();
		$this->save_settings();
		$this->cookiepro_ccpc_button_floatings = get_option( 'CookieProCCPAButtonFloatings' );
		$this->banner_settings_constant        = array(
			'constant'      => $this->get_constant_data_array(),
			'field'         => $this->get_banner_setting_data_as_array(),
			'behavior'      => $this->get_banner_behaviors_setting_data_as_array(),
			'Floating'      => $this->cookiepro_ccpc_button_floatings,
			'publishstatus' => $this->display_status(),
		);
		include_once WP_PLUGIN_DIR . '/' . $this->plugin->name . '/views/settings.php';
	}

	/** Publish all settings */
	public function save_settings() {
		if ( isset( $_REQUEST['Publish'] ) ) {
			$this->banner_settings         = get_option( 'cookieproCCPASettingsPreview' );
			$this->banner_bhavior_settings = get_option( 'cookieproCCPABehaviorSettingsPreview' );
			if ( ! isset( $_REQUEST[ $this->plugin->name . '_nonce' ] ) ) {
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-draft' ), __( 'An error has occurred. Changes have not been saved.' ), 'error' );
			} elseif ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST[ $this->plugin->name . '_nonce' ] ) ), wp_unslash( $this->plugin->name ) ) ) {
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-draft' ), __( 'An error has occurred. Changes have not been saved.' ), 'error' );
			} else {
				if( empty( $this->banner_settings ) ){
					$this->set_banner_setting_data( $this->get_banner_setting_data_as_array() );
					$this->set_publish_status( 'Published', $this->get_banner_setting_data_as_array() );
					update_option( 'cookieproCCPASettingsPreview', $this->get_banner_setting_data_as_array() );
					update_option( 'cookieproCCPASettings', $this->get_banner_setting_data_as_array() );
				} else {	
					// popup settings.
					$this->set_banner_setting_data( $this->banner_settings );
					$this->set_publish_status( 'Published', $this->banner_settings );
					update_option( 'cookieproCCPASettingsPreview', $this->get_banner_setting_data_as_array() );
					update_option( 'cookieproCCPASettings', $this->get_banner_setting_data_as_array() );
				}
				if( empty( $this->banner_bhavior_settings ) ){
					// behaviors settings.
					$this->set_banner_behavior_setting_data( $this->get_banner_behaviors_setting_data_as_array() );
					$this->set_publish_status( 'Published', $this->get_banner_behaviors_setting_data_as_array() );
					update_option( 'cookieproCCPABehaviorSettingsPreview', $this->get_banner_behaviors_setting_data_as_array() );
					update_option( 'cookieproCCPABehaviorSettings', $this->get_banner_behaviors_setting_data_as_array() );
				} else {
					// behaviors settings.
					$this->set_banner_behavior_setting_data( $this->banner_bhavior_settings );
					$this->set_publish_status( 'Published', $this->banner_bhavior_settings );
					update_option( 'cookieproCCPABehaviorSettingsPreview', $this->get_banner_behaviors_setting_data_as_array() );
					update_option( 'cookieproCCPABehaviorSettings', $this->get_banner_behaviors_setting_data_as_array() );
				}

				update_option( 'CookieProCCPAButtonFloatings', array() );
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-published' ), __( 'Settings Published.' ), 'updated' );
			}
		}
	}

	/** Save popup and button settings */
	public function save_banner_settings() {
		$this->banner_settings = get_option( 'cookieproCCPASettingsPreview' );
		if ( isset( $_REQUEST['Submit'] ) ) {
			if ( ! isset( $_REQUEST[ $this->plugin->name . '_nonce' ] ) ) {
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-draft' ), __( 'An error has occurred. Changes have not been saved.' ), 'error' );
			} elseif ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST[ $this->plugin->name . '_nonce' ] ) ), wp_unslash( $this->plugin->name ) ) ) {
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-draft' ), __( 'An error has occurred. Changes have not been saved.' ), 'error' );
			} else {
					update_option( 'CookieProCCPAButtonFloatings', array() );
					$this->set_banner_settings_form_data( $_REQUEST );
					$this->set_publish_status( 'Draft', $this->banner_settings );
					update_option( 'cookieproCCPASettingsPreview', $this->get_banner_setting_data_as_array() );
					// display success message in admin.
					add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-draft' ), __( 'Settings saved. Please click publish below to publish to your site.' ), 'updated' );
			}
		} elseif ( isset( $_REQUEST['RevertToDefault'] ) ) {
			if ( ! isset( $_REQUEST[ $this->plugin->name . '_nonce' ] ) ) {
				$this->error_message = __( 'An error has occurred. Changes have not been saved.' );
			} elseif ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST[ $this->plugin->name . '_nonce' ] ) ), wp_unslash( $this->plugin->name ) ) ) {
				$this->error_message = __( 'An error has occurred. Changes have not been saved.' );
			} else {
				update_option( 'CookieProCCPAButtonFloatings', array() );
				$this->set_default_data();
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-published' ), __( 'Reset to Default Settings. Please click save button to save the settings.' ), 'updated' );
			}
		} elseif ( $this->banner_settings ) {
			$this->set_banner_setting_data( $this->banner_settings );
		} else {
			$this->set_default_data();
		}
	}


	/** Save Behavior settings */
	public function save_banner_behavior_settings() {
		$this->banner_settings = get_option( 'cookieproCCPABehaviorSettingsPreview' );
		if ( isset( $_REQUEST['SubmitBehaviors'] ) ) {
			if ( ! isset( $_REQUEST[ $this->plugin->name . '_behavior_nonce' ] ) ) {
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-draft' ), __( 'An error has occurred. Changes have not been saved.' ), 'error' );
			} elseif ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST[ $this->plugin->name . '_behavior_nonce' ] ) ), wp_unslash( $this->plugin->name ) ) ) {
				$this->error_message = __( 'An error has occurred. Changes have not been saved.' );
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-draft' ), __( 'An error has occurred. Changes have not been saved.' ), 'error' );
			} else {
					$this->set_banner_behavior_settings_form_data( $_REQUEST );
					$this->set_publish_status( 'Draft', $this->banner_settings );
					update_option( 'cookieproCCPABehaviorSettingsPreview', $this->get_banner_behaviors_setting_data_as_array() );
					add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-draft' ), __( 'Settings saved. Please click publish below to publish to your site.' ), 'updated' );
			}
		} elseif ( isset( $_REQUEST['RevertToDefaultBehaviors'] ) ) {
			if ( ! isset( $_REQUEST[ $this->plugin->name . '_behavior_nonce' ] ) ) {
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-published' ), __( 'An error has occurred. Changes have not been saved.' ), 'error' );
			} elseif ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST[ $this->plugin->name . '_behavior_nonce' ] ) ), wp_unslash( $this->plugin->name ) ) ) {
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-published' ), __( 'An error has occurred. Changes have not been saved.' ), 'error' );
			} else {
				$this->set_behaviors_default_data();
				add_settings_error( 'cookieproccpa_settings_notice', esc_attr( 'settings-published' ), __( 'Reset to Default Settings. Please click save button to save the settings.' ), 'updated' );
			}
		} elseif ( $this->banner_settings ) {
			$this->set_banner_behavior_setting_data( $this->banner_settings );
		} else {
			$this->set_behaviors_default_data();
		}
	}

	/**
	 * Set the status as publish when we click on publish
	 *
	 * @param string $publish_status a string variable.
	 * @param array  $banner_settings an array variable.
	 */
	public function set_publish_status( $publish_status, $banner_settings ) {
		$this->publish_status = $publish_status;
		if ( 'Published' === $publish_status ) {
			$this->last_published = gmdate( 'Y-m-d H:i:s' );
		} else {
			$this->last_published = $banner_settings['lastPublished'] ? $banner_settings['lastPublished'] : '';
		}
	}

	/**  Display the publish status and time */
	public function display_status() {
		$banner_status          = get_option( 'cookieproCCPASettingsPreview' );
		$banner_behavior_status = get_option( 'cookieproCCPABehaviorSettingsPreview' );
		$this->settings_status  = 'Draft';
		$this->settings_publish_time = '';
		if( ! empty( $banner_status ) && ! empty( $banner_behavior_status ) ){
			if ( 'Published' === $banner_status['publishStatus'] && 'Published' === $banner_behavior_status['publishStatus'] ) {
				$this->settings_status = 'Published';
			}
			$this->settings_publish_time = $banner_status['lastPublished'];
		}
		return array(
			'status'        => $this->settings_status,
			'lastpublished' => $this->settings_publish_time,
		);
	}

	/** Set the default setting values */
	public function set_default_data() {
		$this->button_text_color       = '#FFFFFF';
		$this->button_background_color = '#6699CC';

		$this->header_text_color       = '#FFFFFF';
		$this->header_background_color = '#6699CC';

		$this->button_text = 'Do Not Sell My Data';

		$this->publish_status = 'Draft';
		$this->last_published = '';

		$this->ot_logo          = '';
		$this->display_position = 'right';
		$this->floating_button	= '';
		$this->isLinkEnabled 	= 'textlink';
	}

	/** Set the default behaviour setting values */
	public function set_behaviors_default_data() {

		$this->is_google_personalize_enabled = 'checked';
		$this->google_confirmation_title     = 'Personalized advertisements';
		$this->google_confirmation_message   = 'Turning this off will opt you out of personalized advertisements delivered from Google on this website.';
		$this->confirmbutton                 = 'Confirm';
		$this->is_email_enabled              = 'checked';
		$this->email_address                 = '';
		$this->popup_main_title              = 'Do Not Sell My Personal Information';
		$this->link_text                     = 'Privacy Policy';
		$this->link_url                      = '';
		$this->privacy_policy_message        = 'Exercise your consumer rights by contacting us below';
		$this->is_phone_enabled              = 'checked';
		$this->phone_number                  = '';
		$this->form_link_text                = 'Exercise Your Rights';
		$this->form_link_url                 = '';
		$this->form_enable                   = 'checked';
		$this->publish_status                = 'Draft';
		$this->last_published                = '';
		$this->selectuseroption				 = 'All';
		$this->isIABEnabled 				 = 'checked';
		$this->isLSPAenable 				 = '';
	}

	/** Assign the default settings in array  */
	public function get_banner_setting_data_as_array() {

		return array(
			'buttonTextColor'       => $this->button_text_color,
			'buttonBackgroundColor' => $this->button_background_color,
			'publishStatus'         => $this->publish_status,
			'lastPublished'         => $this->last_published,
			'otLogo'                => $this->ot_logo,
			'DisplayPosition'       => $this->display_position,
			'headerTextcolor'       => $this->header_text_color,
			'headerBackgroundcolor' => $this->header_background_color,
			'isButtonEnabled'	 	=> $this->floating_button,
			'isLinkEnabled'			=> $this->isLinkEnabled
		);
	}

	/** Assign the default behaviour settings in array  */
	public function get_banner_behaviors_setting_data_as_array() {

		return array(
			'isGooglePersonalizeEnabled' => $this->is_google_personalize_enabled,
			'googleConfirmationTitle'    => $this->google_confirmation_title,
			'googleConfirmationMessage'  => $this->google_confirmation_message,
			'popup_main_title'           => $this->popup_main_title,
			'linkText'                   => $this->link_text,
			'linkURL'                    => $this->link_url,
			'PrivacyPolicyMessage'       => $this->privacy_policy_message,
			'isEmailEnabled'             => $this->is_email_enabled,
			'emailAddress'               => $this->email_address,
			'isPhoneEnabled'             => $this->is_phone_enabled,
			'phoneNumber'                => $this->phone_number,
			'form_link_text'             => $this->form_link_text,
			'form_link_url'              => $this->form_link_url,
			'publishStatus'              => $this->publish_status,
			'lastPublished'              => $this->last_published,
			'form_enable'                => $this->form_enable,
			'confirmbutton'              => $this->confirmbutton,
			'selectuseroption'           => $this->selectuseroption,
			'isIABEnabled' 				 => $this->isIABEnabled,
			'isLSPAenable'				 => $this->isLSPAenable
		);
	}


	/**
	 * Save the publish status
	 *
	 * @param array $banner_data .
	 */
	public function set_banner_setting_data( $banner_data ) {
		$this->set_banner_settings_form_data( $banner_data );
		$this->publish_status = $banner_data['publishStatus'];
		$this->last_published = $banner_data['lastPublished'];
	}

	/**
	 * Get the database values and overwrite the default values
	 *
	 * @param array $banner_data .
	 */
	public function set_banner_settings_form_data( $banner_data ) {
		$this->button_text_color       = $banner_data['buttonTextColor'];
		$this->button_background_color = $banner_data['buttonBackgroundColor'];
		$this->ot_logo                 = $banner_data['otLogo'];
		$this->display_position        = $banner_data['DisplayPosition'];
		$this->header_background_color = $banner_data['headerBackgroundcolor'];
		$this->header_text_color       = $banner_data['headerTextcolor'];

		$this->floating_button_options = get_option( 'CookieProCCPAButtonFloatings' );
		if( ! empty( $this->floating_button_options ) ){
		$this->floating_button		   = is_array( $this->floating_button_options ) && array_key_exists( 'isButtonEnabled', $this->floating_button_options ) ? ( 'checked' === $this->floating_button_options['isButtonEnabled'] ? 'checked' : '' ) : '';
		$this->isLinkEnabled 		   = is_array( $this->floating_button_options ) && array_key_exists( 'isLinkEnabled', $this->floating_button_options ) ? ( 'checked' === $this->floating_button_options['isLinkEnabled'] ? 'textlink' : '' ) : '';
		} else {
		$this->floating_button		   = is_array( $banner_data ) && array_key_exists( 'isButtonEnabled', $banner_data ) ? ( 'checked' === $banner_data['isButtonEnabled'] ? 'checked' : '' ) : '';
		$this->isLinkEnabled 		   = is_array( $banner_data ) && array_key_exists( 'isLinkEnabled', $banner_data ) ? ( 'textlink' === $banner_data['isLinkEnabled'] ? 'textlink' : $banner_data['isLinkEnabled'] ) : '';
		}
	}

	/**
	 * Save the publish status
	 *
	 * @param array $banner_data .
	 */
	public function set_banner_behavior_setting_data( $banner_data ) {
		$this->set_banner_behavior_settings_form_data( $banner_data );
		$this->publish_status = $banner_data['publishStatus'];
		$this->last_published = $banner_data['lastPublished'];
	}

	/**
	 * Get the database values and overwrite the default values
	 *
	 * @param array $banner_data .
	 */
	public function set_banner_behavior_settings_form_data( $banner_data ) {
		$this->is_google_personalize_enabled = is_array( $banner_data ) && array_key_exists( 'isGooglePersonalizeEnabled', $banner_data ) ? ( 'on' === $banner_data['isGooglePersonalizeEnabled'] ? 'checked' : $banner_data['isGooglePersonalizeEnabled'] ) : '';
		$this->google_confirmation_title     = $banner_data['googleConfirmationTitle'];
		$this->google_confirmation_message   = $banner_data['googleConfirmationMessage'];
		$this->is_email_enabled              = is_array( $banner_data ) && array_key_exists( 'isEmailEnabled', $banner_data ) ? ( 'on' === $banner_data['isEmailEnabled'] ? 'checked' : $banner_data['isEmailEnabled'] ) : 'off';
		$this->confirmbutton                 = $banner_data['confirmbutton'];
		$this->link_text                     = $banner_data['linkText'];
		$this->link_url                      = $banner_data['linkURL'];
		$this->popup_main_title              = $banner_data['popup_main_title'];
		$this->privacy_policy_message        = $banner_data['PrivacyPolicyMessage'];
		$this->email_address                 = $banner_data['emailAddress'];
		$this->is_phone_enabled              = is_array( $banner_data ) && array_key_exists( 'isPhoneEnabled', $banner_data ) ? ( 'on' === $banner_data['isPhoneEnabled'] ? 'checked' : $banner_data['isPhoneEnabled'] ) : '';
		$this->form_enable                   = is_array( $banner_data ) && array_key_exists( 'form_enable', $banner_data ) ? ( 'on' === $banner_data['form_enable'] ? 'checked' : $banner_data['form_enable'] ) : '';
		$this->phone_number                  = $banner_data['phoneNumber'];
		$this->form_link_url                 = $banner_data['form_link_url'];
		$this->form_link_text                = $banner_data['form_link_text'];
		$this->selectuseroption              = is_array( $banner_data ) && array_key_exists( 'selectuseroption', $banner_data ) ? $banner_data['selectuseroption'] : 'All' ;
		$this->isIABEnabled					 = is_array( $banner_data ) && array_key_exists( 'isIABEnabled', $banner_data ) ? ( 'iab' === $banner_data['isIABEnabled'] ? 'checked' : $banner_data['isIABEnabled'] ) : '';
		$this->isLSPAenable 				 = is_array( $banner_data ) && array_key_exists( 'isLSPAenable', $banner_data ) ? ( 'on' === $banner_data['isLSPAenable'] ? 'checked' : $banner_data['isLSPAenable'] ) : '';
	}

	/** Label field values  */
	public function get_constant_data_array() {
		return array(
			// button setting.
			'settings'                         => 'Button Settings',
			'behaviors'                        => 'Modal Settings',
			'buttonLabel'                      => 'Need for a Button',
			'buttonDescription'                => 'This button will float in the buttom left corner of the site',
			'buttonText'                       => 'Buttom Text',
			'popuptitle'                       => 'Title',
			'linkText'                         => 'Policy Label',
			'linkURL'                          => 'Policy URL',
			'PrivacyPolicyMessage'             => 'Message',
			'buttonColor'                      => 'Button Colors',
			'buttonColorText'                  => 'Button Text',
			'buttonColorBackground'            => 'Button Background',
			// Header Background Color Settings.
			'headercolors'                     => 'Header Colors',
			'headerBackgroundText'             => 'Header and Icon Background',
			'headerText'                       => 'Header Text',
			// Logo Change settings.
			'logolabel'                        => 'Icon',
			'DisplayPosition'                  => 'Button Position',
			// link settings.
			'linkLabel'                        => 'Need for a Link',
			'linkDescription'                  => 'Copy the follwing snippet and paste it into your pages',
			'snippet'                          => '',
			'snippetButtonText'                => 'Copy',
			'selectuseroption' 				   => 'Select User Access',
			'OptoutButtonEnable'			   => 'Opt-out Button',			
			// request form settings.
			'requestFormLabel'                 => 'Consumer Rights Request Form',
			'formlinkLabel'                    => 'Link Label',
			'formLinkURLLabel'                 => 'Form URL',
			// google settings.
			'googleSettingLabel'               => 'Opt-out of Ad Partners',
			'googleSettingDescription'         => 'Disable Google and its technology partners from collecting data and using cookies for advertisements personalization and measurement.',
			'googleSettingConfirmationTitle'   => 'Toggle Label',
			'googleSettingConfirmationMessage' => 'Message',
			'confirmbuttonlabel'               => 'Confirm Label',
			'isIABEnabledlabel'				   => 'Utilize the IAB CCPA framework to Opt-out of Sale',
			'isLSPAlabel'					   => 'My business has signed the IAB Limited Service Provider Agreement.',
			// email settings.
			'emailLabel'                       => 'Display Email Address?',
			'emailAddressLabel'                => 'Email Address',
			'emailAddressPlaceholder'          => 'support@domain.com',
			// phone settings.
			'phoneLabel'                       => 'Display Phone Number?',
			'phoneNumberLabel'                 => 'Phone Number',
			'phoneNumberPlaceholder'           => '555-555-5555',
			// setting buttons.
			'saveButtonText'                   => 'Save',
			'defaultButtonText'                => 'Reset to Default',
			// side menu.
			'isButtonEnabled'                  => 'Floating Button',
			'isLinkEnabled'                    => 'Text Link',
			// Publish settings.
			'publishText'                      => 'Publish',
			'statusText'                       => 'Status :',
			'lastPublishText'                  => 'Last Published:',
			'publishButtonText'                => 'Publish',
			// Preview settings.
			'Preview'                          => 'Preview',
		);
	}

}


$cookiepro = new CookieproCCPA();

