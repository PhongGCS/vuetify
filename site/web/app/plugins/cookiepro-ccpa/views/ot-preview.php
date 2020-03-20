<?php
/**
 * Preview settings page in admin
 *
 * @package CookieProCCPA
 */

?>
<div class="ot-container">
	<article>
		<span class="settings-text"><?php echo esc_html( $this->banner_settings_constant['constant']['Preview'] ); ?></span>
		<span class="shortdescription">Save changes to update preview</span>
	</article>
	<article>
		<?php require_once $this->plugin->folder . 'views/ot-preview-settings.php'; ?>
	</article>
</div>
