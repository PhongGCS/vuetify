<?php
/**
 * Form Logo Settings
 *
 * @package CookieProCCPA
 */

?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		var custom_uploader;
		$('#ot_upload_image').click(function(e) {
			e.preventDefault();
			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}
			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				multiple: false
			});
			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {
				attachment = custom_uploader.state().get('selection').first().toJSON();
				$('#otimage_path').val(attachment.url);
			});
			//Open the uploader dialog
			custom_uploader.open(); 
		});

		// remove image on click
		$('.otformImage').click(function (e) {
			$(this).css('display','none');
			$(this).parent().find('img').not(this).remove();
			$('#otimage_path').val('');
		});
	});
</script>

<div class="form-control-group">
	<label class="form-control-label">
		<?php echo esc_html( $this->banner_settings_constant['constant']['buttonColor'] ); ?>
	</label>
	<div class="form-control">
		<label class="background-colorpicker" for="color-picker-background">
			<?php echo esc_html( $this->banner_settings_constant['constant']['buttonColorBackground'] ); ?>
		</label>
		<label class="text-colorpicker" for="color-picker-text">
			<?php echo esc_html( $this->banner_settings_constant['constant']['buttonColorText'] ); ?>
		</label>
	</div>
</div>
<div class="form-control-group">
	<label class="form-control-label">
	</label>
	<div class="form-control">
		<div class="background-colorpicker ">
			<div class="ot-color-picker margin-top">
				<input id="ot-CCPA-button-background-color-picker" name="buttonBackgroundColor" type="color"
					value='<?php echo esc_attr( $this->banner_settings_constant['field']['buttonBackgroundColor'] ); ?>'>
				<input id="ot-CCPA-button-background-text-box" class="color-picker-text-edit" type="text"
					value='<?php echo esc_attr( $this->banner_settings_constant['field']['buttonBackgroundColor'] ); ?>'>
			</div>
		</div>        
		<div class="text-colorpicker">
			<div class="ot-color-picker margin-top">
				<input id="ot-CCPA-button-text-color-picker" name="buttonTextColor" type="color"
					value='<?php echo esc_attr( $this->banner_settings_constant['field']['buttonTextColor'] ); ?>'>
				<input id="ot-CCPA-button-text-box" class="color-picker-text-edit" type="text"
					value='<?php echo esc_attr( $this->banner_settings_constant['field']['buttonTextColor'] ); ?>'>
			</div>
		</div>
	</div>
</div>
<div class="form-control-group">
	<label class="form-control-label">
		<?php echo esc_html( $this->banner_settings_constant['constant']['headercolors'] ); ?>
	</label>
	<div class="form-control">
		<label class="background-colorpicker" for="color-picker-background">
			<?php echo esc_html( $this->banner_settings_constant['constant']['headerBackgroundText'] ); ?>
		</label>
		<label class="text-colorpicker" for="color-picker-text">
			<?php echo esc_html( $this->banner_settings_constant['constant']['headerText'] ); ?>
		</label>
	</div>
</div>
<div class="form-control-group">
	<label class="form-control-label">
	</label>
	<div class="form-control">
		<div class="background-colorpicker ">
			<div class="ot-color-picker margin-top">
				<input id="ot-CCPA-header-background-color-picker" name="headerBackgroundcolor" type="color"
					value='<?php echo esc_attr( $this->banner_settings_constant['field']['headerBackgroundcolor'] ); ?>'>
				<input id="ot-CCPA-header-background-text-box" class="color-picker-text-edit" type="text"
					value='<?php echo esc_attr( $this->banner_settings_constant['field']['headerBackgroundcolor'] ); ?>'>
			</div>
		</div>        
		<div class="text-colorpicker">
			<div class="ot-color-picker margin-top">
				<input id="ot-CCPA-header-text-color-picker" name="headerTextcolor" type="color"
					value='<?php echo esc_attr( $this->banner_settings_constant['field']['headerTextcolor'] ); ?>'>
				<input id="ot-CCPA-header-text-box" class="color-picker-text-edit" type="text"
					value='<?php echo esc_attr( $this->banner_settings_constant['field']['headerTextcolor'] ); ?>'>
			</div>
		</div>
	</div>
</div>

<div class="form-control-group">
	<label class="form-control-label" for="button-text">
		<?php echo esc_html( $this->banner_settings_constant['constant']['DisplayPosition'] ); ?>
	</label>
	<div class="form-control" id="donate">
			<label class="blue"><input type="radio" name="DisplayPosition" value="left" <?php echo esc_html( 'left' === $this->banner_settings_constant['field']['DisplayPosition'] ? 'checked' : '' ); ?> ><span>Left</span></label>
			<label class="green"><input type="radio" name="DisplayPosition" value="right" <?php echo esc_html( 'right' === $this->banner_settings_constant['field']['DisplayPosition'] ? 'checked' : '' ); ?>><span>Right</span></label>
	</div>
</div>
