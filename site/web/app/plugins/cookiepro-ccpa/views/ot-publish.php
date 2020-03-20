<?php
/**
 * Main file of the publish settings
 *
 * @package CookieProCCPA
 */

?>
<div class="ot-container ot-preview">
	<article>
		<span
			class="settings-text"><?php echo esc_html( $this->banner_settings_constant['constant']['publishText'] ); ?></span>
	</article>

	<article>
		<?php require_once $this->plugin->folder . 'views/ot-publish-body.php'; ?>
	</article>
		<?php require_once $this->plugin->folder . 'views/ot-publish-settings.php'; ?>
</div>
