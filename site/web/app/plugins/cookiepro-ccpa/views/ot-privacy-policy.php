<?php
/**
 * Form privacy policy settings
 *
 * @package CookieProCCPA
 */

?>
<div class="form-control-group">
	<label class="form-control-label" for="link-text">
		<?php echo esc_html( $this->banner_settings_constant['constant']['popuptitle'] ); ?>
	</label>
	<div class="form-control">
		<input class="form-textbox" name="popup_main_title" type="Text" placeholder="Do Not Sell My Personal Information"
			value='<?php echo esc_attr( stripslashes( $this->banner_settings_constant['behavior']['popup_main_title'] ) ); ?>'>
	</div>
</div>

<div class="form-control-group">
	<label class="form-control-label">
		<?php echo esc_html( $this->banner_settings_constant['constant']['PrivacyPolicyMessage'] ); ?>
	</label>
	<div class="form-control">
		<textarea class="form-textarea" name="PrivacyPolicyMessage" rows="6"><?php echo esc_html( stripslashes( $this->banner_settings_constant['behavior']['PrivacyPolicyMessage'] ) ); ?></textarea>
	</div>
</div>

<div class="form-control-group">
	<label class="form-control-label" for="link-text">
		<?php echo esc_html( $this->banner_settings_constant['constant']['linkText'] ); ?>
	</label>
	<div class="form-control">
		<input class="form-textbox" name="linkText" type="Text" placeholder="Privacy Policy"
			value='<?php echo esc_attr( stripslashes( $this->banner_settings_constant['behavior']['linkText'] ) ); ?>'>
	</div>
</div>

<div class="form-control-group">
	<label class="form-control-label" for="link-URL">
		<?php echo esc_html( $this->banner_settings_constant['constant']['linkURL'] ); ?>
	</label>
	<div class="form-control">
		<input class="form-textbox" name="linkURL" type="Text" placeholder="Enter a URL to your privacy policy"
			value='<?php echo esc_attr( $this->banner_settings_constant['behavior']['linkURL'] ); ?>'>
	</div>
</div>

