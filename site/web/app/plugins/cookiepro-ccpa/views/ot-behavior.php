<?php
/**
 * Behaviour Form files included
 *
 * @package CookieProCCPA
 */

?>
<form action="" method="post" class="behaviors-form">
	<!-- Content -->
	<div class="ot-container">
		<article>
			<span class="settings-text"><?php echo esc_html( $this->banner_settings_constant['constant']['behaviors'] ); ?></span>
		</article>
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-privacy-policy.php'; ?>
		</article> 
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-user-options.php'; ?>
		</article>     
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-body-email-settings.php'; ?>
		</article>
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-body-phone-settings.php'; ?>
		</article>
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-body-request-form-settings.php'; ?>
		</article>		
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-body-google-settings.php'; ?>
		</article>
		<article>
			<?php require_once $this->plugin->folder . 'views/ot-body-submit-settings.php'; ?>
		</article>
	</div>
</form>
