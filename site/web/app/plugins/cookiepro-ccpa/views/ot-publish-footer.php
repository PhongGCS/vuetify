<?php
/**
 * Form publishing all settings
 *
 * @package CookieProCCPA
 */

?>
<div class="form-control-group">
	<div class="form-control ot-footer">
			<?php wp_nonce_field( $this->plugin->name, $this->plugin->name . '_nonce' ); ?>
			<input class="margin-left primary-button pull-right" type="submit" name="Publish"
				value="<?php echo esc_attr( $this->banner_settings_constant['constant']['publishButtonText'] ); ?>">
	</div>
</div>
