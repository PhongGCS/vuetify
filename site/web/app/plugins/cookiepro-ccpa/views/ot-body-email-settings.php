<?php
/**
 * Email settings for update
 *
 * @package CookieProCCPA
 */

?>
<div class="form-control-group">
	<label class="form-control-label" for="buttom-left">
		<?php echo esc_html( $this->banner_settings_constant['constant']['emailLabel'] ); ?>
	</label>
	<div class="form-control">
		<input class="ot-checkbox" name="isEmailEnabled" id="isEmailEnabled" type="checkbox"
			<?php echo esc_html( $this->banner_settings_constant['behavior']['isEmailEnabled'] ); ?> >
		<span class="ot-checkbox-text">
			If a site visitor clicks the Do Not Sell Button, they will be provided with the email address entered below that they can contact if further action is needed to complete the consumer rights request. <a href="https://www.cookiepro.com/data-subject-rights/" target="_blank">Learn More</a>
		</span>
	</div>
</div>

<div class="form-control-group EmailEnabled">
	<label class="form-control-label">
		<?php echo esc_html( $this->banner_settings_constant['constant']['emailAddressLabel'] ); ?>
	</label>
	<div class="form-control">
		<input class="form-textbox Emaildisable" name="emailAddress" type="Text" value='<?php echo esc_attr( $this->banner_settings_constant['behavior']['emailAddress'] ); ?>'placeholder="<?php echo esc_attr( $this->banner_settings_constant['constant']['emailAddressPlaceholder'] ); ?>">
	</div>
</div>
