<?php
/**
 * Form Phone number settings
 *
 * @package CookieProCCPA
 */

?>
<div class="form-control-group">
	<label class="form-control-label" for="isPhoneEnabled">
		<?php echo esc_html( $this->banner_settings_constant['constant']['phoneLabel'] ); ?>
	</label>
	<div class="form-control">
		<input class="ot-checkbox" name="isPhoneEnabled" id="isPhoneEnabled" type="checkbox"
			<?php echo esc_html( $this->banner_settings_constant['behavior']['isPhoneEnabled'] ); ?>>
		<span class="ot-checkbox-text">
			If a site visitor clicks the Do Not Sell Button, they will be provided with the phone number entered below that they can contact if further action is needed to complete the consumer rights request. <a href="https://www.cookiepro.com/data-subject-rights/" target="_blank">Learn More</a> 
		</span>
	</div>
</div>

<div class="form-control-group PhoneEnabled">
	<label class="form-control-label">
		<?php echo esc_html( $this->banner_settings_constant['constant']['phoneNumberLabel'] ); ?>
	</label>
	<div class="form-control">
		<input class="form-textbox Phonedisable" name="phoneNumber" type="Text"
			value='<?php echo esc_attr( $this->banner_settings_constant['behavior']['phoneNumber'] ); ?>'
			placeholder="<?php echo esc_attr( $this->banner_settings_constant['constant']['phoneNumberPlaceholder'] ); ?>">
	</div>
</div>
