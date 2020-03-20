<?php
/**
 * Form body Settings
 *
 * @package CookieProCCPA
 */

?>
<form action="" method="post">
	<!-- Content -->
	<div class="ot-container">
		<article>
			<span class="settings-text"><?php echo esc_html( $this->banner_settings_constant['constant']['settings'] ); ?></span>
		</article>
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-opt-out-button.php'; ?>
		</article>
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-floating-button.php'; ?>
		</article>				
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-body-logo-settings.php'; ?>
		</article>
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-body-footer-settings.php'; ?>
			<!-- /normal-sortables -->
		</article>
	</div>
</form>
