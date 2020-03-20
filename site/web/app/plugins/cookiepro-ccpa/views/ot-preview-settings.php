<?php
/**
 * Form submit button and revert button settings
 *
 * @package CookieProCCPA
 */

?>
<div class="form-control-group ot-preview-body">
	<?php
	$position_class = '';
	if ( 'left' === $this->banner_settings_constant['field']['DisplayPosition'] ) {
		$position_class = 'leftaligncontent';
	}
	if( 'checked' === $this->banner_settings_constant['field']['isButtonEnabled'] ){
	?>
	<span class="previewheading">Floating Button</span>
	<div class="ot-preview-background ot-preview-screen">
		<div class="ot-banner-button <?php echo esc_attr( $position_class ); ?>" style="background-color: <?php echo esc_attr( $this->banner_settings_constant['field']['headerBackgroundcolor'] ); ?>;">
			<?php if ( ! empty( $this->banner_settings_constant['field']['otLogo'] ) ) { ?>
				<img src="<?php echo esc_url( $this->banner_settings_constant['field']['otLogo'] ); ?>" alt="CookiePro Do Not Sell" title="CookiePro Do Not Sell">     		
			<?php } else { ?>
				<img src="<?php echo esc_url( $this->plugin->url ); ?>assets/images/icon.png" alt="CookiePro Do Not Sell" title="CookiePro Do Not Sell">
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	<span class="previewheading">Inline Button</span>
	<div class="ot-preview-background ot-preview-screen">
		<div class="ot-banner-button-two">
			<?php if( 'textlink' === $this->banner_settings_constant['field']['isLinkEnabled'] ){ ?>
			<a id='otCCPAdoNotSellLink' href='javascript:void(0);' data-ot-ccpa-opt-out='button'>Do Not Sell My Personal Information</a>	
			<?php } else if( 'buttonlink' === $this->banner_settings_constant['field']['isLinkEnabled'] ){ ?>	
			<button type="button" data-ot-ccpa-opt-out="button" style="display:inline-block;" class="ot-ccpa-optout__button ot-ccpa-optout__button--light"><img src="https://cookie-cdn.cookiepro.com/ccpa-optout-solution/v1/assets/icon-do-not-sell.svg" style="width:30px;height:30px;" alt="" role="presentation"><span class="ot-ccpa-optout__button__title">Do Not Sell My Personal Information</span><span class="ot-ccpa-optout__button__subtitle"><img style="display:block!important;opacity:1!important;height:25px!important;width:152px!important;" src="https://cookie-cdn.cookiepro.com/ccpa-optout-solution/v1/assets/poweredbycookiepro.svg" title="Powered by CookiePro" alt="Powered by CookiePro"></span></button>
			<?php } ?>
		</div>
	</div>

	<span class="previewheading">Modal</span>
	<div class="ot-preview-background popupbutton popupcloseicon <?php echo esc_attr( $position_class ); ?>">
		<div class="ot-banner-confirmation-popup">
			<div class="side-popup-column-main" style="background-color: <?php echo esc_attr( $this->banner_settings_constant['field']['headerBackgroundcolor'] ); ?>;color: <?php echo esc_attr( $this->banner_settings_constant['field']['headerTextcolor'] ); ?>">
				<p class="popup-title-main"><?php echo esc_html( stripslashes( $this->banner_settings_constant['behavior']['popup_main_title'] ) ); ?></p>
				<p class="ot-confirmation-popup-text">
					<?php echo esc_html( stripslashes( $this->banner_settings_constant['behavior']['PrivacyPolicyMessage'] ) ); ?>
					<?php if ( ! empty( $this->banner_settings_constant['behavior']['linkURL'] ) ) { ?>
						<a href="<?php echo esc_url( $this->banner_settings_constant['behavior']['linkURL'] ); ?>" target="_blank" style="color: <?php echo esc_attr( $this->banner_settings_constant['field']['headerTextcolor'] ); ?>"><?php echo esc_html( $this->banner_settings_constant['behavior']['linkText'] ); ?></a>
					<?php } ?>
				</p>	
				<p class="ot-confirmation-popup-text">
					<?php if ( 'checked' === $this->banner_settings_constant['behavior']['isEmailEnabled'] && ! empty( $this->banner_settings_constant['behavior']['emailAddress'] ) ) { ?>
					<span class="email-address-icon">
						<a href="mailto:<?php echo esc_attr( $this->banner_settings_constant['behavior']['emailAddress'] ); ?>" style="color: <?php echo esc_attr( $this->banner_settings_constant['field']['headerTextcolor'] ); ?>"><?php echo esc_html( $this->banner_settings_constant['behavior']['emailAddress'] ); ?></a>
						<br />
					</span>
					<?php } if ( 'checked' === $this->banner_settings_constant['behavior']['isPhoneEnabled'] && ! empty( $this->banner_settings_constant['behavior']['phoneNumber'] ) ) { ?>
					<span class="phone-number-icon">
						<a href="tel:<?php echo esc_attr( $this->banner_settings_constant['behavior']['phoneNumber'] ); ?>" style="color: <?php echo esc_attr( $this->banner_settings_constant['field']['headerTextcolor'] ); ?>"><?php echo esc_html( $this->banner_settings_constant['behavior']['phoneNumber'] ); ?></a>
					</span> <br />
					<?php } if ( 'checked' === $this->banner_settings_constant['behavior']['form_enable'] && ! empty( $this->banner_settings_constant['behavior']['form_link_url'] ) ) { ?>
					<span class="form-link-icon">
						<a href="<?php echo esc_url( $this->banner_settings_constant['behavior']['form_link_url'] ); ?>" target="_blank" style="color: <?php echo esc_attr( $this->banner_settings_constant['field']['headerTextcolor'] ); ?>"><?php echo esc_html( stripslashes( $this->banner_settings_constant['behavior']['form_link_text'] ) ); ?></a>
					</span>
					<?php } ?>
				</p>
			</div>
			<?php if ( 'checked' === $this->banner_settings_constant['behavior']['isGooglePersonalizeEnabled'] ) { ?>
			<div class="personal-info">
				<div class="ot-confirmation-popup-header">
					<p class="personal-info-title"><?php echo esc_html( stripslashes( $this->banner_settings_constant['behavior']['googleConfirmationTitle'] ) ); ?></p>
					<label class="ot-toggle-switch googleConfirmation">
						<input type="checkbox" name="ConfirmationEnabled" id="ConfirmationEnabled" checked>
						<span class="ot-toggle-slider sliderinfo round"></span>
					</label>
					<div class="clearboth"></div>						
				</div>
				<p class="ot-confirmation-popup-text">
					<?php echo esc_html( stripslashes( $this->banner_settings_constant['behavior']['googleConfirmationMessage'] ) ); ?>
				</p>					
			</div>	
			<?php } ?>															
			<div class="popup-footer">	
				<div class="powered-by-icon">
					<img src="<?php echo esc_url( $this->plugin->url ); ?>assets/images/PoweredByCookiePro.svg" alt="CookiePro" title="CookiePro">
				</div>
				<?php if ( 'checked' === $this->banner_settings_constant['behavior']['isGooglePersonalizeEnabled'] ) { ?>
				<div class="ot-banner-button ConfirmBtn" style="background-color:<?php echo esc_attr( $this->banner_settings_constant['field']['buttonBackgroundColor'] ); ?>;">
					<input type="button" value="<?php echo esc_attr( $this->banner_settings_constant['behavior']['confirmbutton'] ); ?>" style="color: <?php echo esc_attr( $this->banner_settings_constant['field']['buttonTextColor'] ); ?>;" />
				</div>
				<?php } ?>
				<div class="clearboth"></div>
			</div>
		</div>		
		<div class="confirmation-popup-close" style="background-color: <?php echo esc_attr( $this->banner_settings_constant['field']['headerBackgroundcolor'] ); ?>;">
			<img src="<?php echo esc_url( $this->plugin->url ); ?>assets/images/Close.svg" alt="Close Icon" title="Close Icon">
		</div>
	</div>
</div>
