<?php
/**
 * Checkbox settings for update
 *
 * @package CookieProCCPA
 */
?>
<div class="form-control-group">
	<label class="form-control-label"></label>
	<div class="form-control floating_button_option">
		<input type="checkbox" name="isButtonEnabled" id="floatingbutton" value="checked" <?php echo esc_html( $this->banner_settings_constant['field']['isButtonEnabled'] ); ?>>
		<span class="ot-checkbox-text"><strong>Floating Button</strong></span>
	</div>
</div>

<div class="form-control-group floating_button_enable" style="display: none;">
	<label class="form-control-label" for="buttom-left">
		<?php echo esc_html( $this->banner_settings_constant['constant']['logolabel'] ); ?>
	</label>
	<div class="form-control">
		<input type='text' name="otLogo" class="image_path width-70" value="<?php echo esc_attr( $this->banner_settings_constant['field']['otLogo'] ); ?>" id="otimage_path" readonly>
		<input type="button" value="Upload Image" class="margin-left primary-button" id="ot_upload_image"/>
	</div>
</div>
<?php if ( ! empty( $this->banner_settings_constant['field']['otLogo'] ) ) { ?>
<div class="form-control-group floating_button_enable" style="display: none;">
	<label class="form-control-label" for="buttom-left">
	</label>
	<div class="form-control upload_logo_img">
		<img src="<?php echo esc_url( $this->banner_settings_constant['field']['otLogo'] ); ?>" alt="" title="" width="200" heght="200">
		<a href="javascript:void(0);" class="otformImage">X</a> 
	</div>
</div>
<?php } ?>