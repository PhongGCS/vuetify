<?php
/**
 * Form submit button and revert button settings
 *
 * @package CookieProCCPA
 */

?>
<div class="form-control-group">
	<div class="form-control ot-footer">
		<?php wp_nonce_field( $this->plugin->name, $this->plugin->name . '_behavior_nonce' ); ?>
		<input class="margin-left white-button pull-right" type="submit" name="RevertToDefaultBehaviors"
			value="<?php echo esc_attr( $this->banner_settings_constant['constant']['defaultButtonText'] ); ?>">
		<input class="margin-left primary-button pull-right" type="submit" name="SubmitBehaviors"
			value="<?php echo esc_attr( $this->banner_settings_constant['constant']['saveButtonText'] ); ?>">
	</div>
</div>
