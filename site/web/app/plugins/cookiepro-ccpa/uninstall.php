<?php
/**
 * Uninstall file. If selected all data from popups plugin will be deleted
 *
 * @package CookieProCCPA
 */

if ( ! defined( 'ABSPATH' ) && ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}


delete_option( 'cookieproCCPASettingsPreview' );
delete_option( 'cookieproCCPASettings' );
delete_option( 'cookieproCCPABehaviorSettingsPreview' );
delete_option( 'cookieproCCPABehaviorSettings' );
delete_option( 'CookieProCCPAButtonFloatings' );
