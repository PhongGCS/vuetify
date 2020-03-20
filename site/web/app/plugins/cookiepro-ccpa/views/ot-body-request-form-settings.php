<?php
/**
 * Form Phone number settings
 *
 * @package CookieProCCPA
 */

?>
<div class="form-control-group">
	<label class="form-control-label" for="form_enable">
		<?php echo esc_html( $this->banner_settings_constant['constant']['requestFormLabel'] ); ?>
	</label>
	<div class="form-control">
		<input class="ot-checkbox" name="form_enable" id="form_enable" type="checkbox"
			<?php echo esc_html( $this->banner_settings_constant['behavior']['form_enable'] ); ?>>
		<span class="ot-checkbox-text">Display link to Consumer Rights Request form. Sign up to get access to your own Data Subject Request portal for free. <a href="https://www.cookiepro.com/data-subject-rights/" target="_blank">Learn More</a>
		</span>
	</div>
</div>

<div class="form-control-group FormEnabled">
	<label class="form-control-label">
		<?php echo esc_html( $this->banner_settings_constant['constant']['formlinkLabel'] ); ?>
	</label>
	<div class="form-control">
		<input class="form-textbox Formdisable" name="form_link_text" type="Text"
			value='<?php echo esc_attr( stripslashes( $this->banner_settings_constant['behavior']['form_link_text'] ) ); ?>'
			placeholder="Exercise Your Rights">
	</div>
</div>

<div class="form-control-group FormEnabled">
	<label class="form-control-label">
		<?php echo esc_attr( $this->banner_settings_constant['constant']['formLinkURLLabel'] ); ?>
	</label>
	<div class="form-control">
		<input class="form-textbox Formdisable" name="form_link_url" type="Text"
			value='<?php echo esc_attr( $this->banner_settings_constant['behavior']['form_link_url'] ); ?>'
			placeholder="Enter Your Request Form URL">
	</div>
</div>
