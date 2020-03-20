<?php
/**
 * Form publish settings status
 *
 * @package CookieProCCPA
 */

?>
<div class="form-control-group">
	<label class="form-control-label-side-bar">
		<?php echo esc_html( $this->banner_settings_constant['constant']['statusText'] ); ?>
	</label>
	<div class="form-control-side-bar">
		<label>
			<?php echo esc_html( $this->banner_settings_constant['publishstatus']['status'] ); ?>
		</label>
	</div>
</div>
<div class="form-control-group">
	<label class="form-control-label-side-bar">
		<?php echo esc_html( $this->banner_settings_constant['constant']['lastPublishText'] ); ?>
	</label>
	<div class="form-control-side-bar">
		<label>
			<?php echo esc_html( $this->banner_settings_constant['publishstatus']['lastpublished'] ); ?>
		</label>
	</div>
</div>
