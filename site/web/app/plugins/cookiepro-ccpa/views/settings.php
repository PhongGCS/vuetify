<?php
/**
 * Settings
 *
 * @category   Components
 * @package    CookiePro
 * @author     WordPress Dev <wordpress@cookiepro.com>
 * @license    GPL2
 * @link       https://cookiepro.com
 * @since      1.0.3
 */

?>

<?php
wp_register_style( 'otCCPAStyle', $this->plugin->url . 'assets/css/style.css', '', '1.0.3', false );
wp_register_script( 'otCCPAScript', $this->plugin->url . 'assets/js/main.js', '', '1.0.3', false );
wp_enqueue_style( 'otCCPAStyle' );
wp_enqueue_script( 'otCCPAScript' );
wp_enqueue_media();
?>
<style type="text/css">
	.updated.settings-error{ margin-left: 30px; }
</style>
<div id="ot-ccpa-banner-settings" class="ot-container">
	<header>
		<?php require_once $this->plugin->folder . 'views/ot-header.php'; ?>
	</header>
	<div style="width: calc( 60% - 5px );">
		<?php settings_errors(); ?>
	</div>
	<div class="grid-layout">
	<section>
		<?php require_once $this->plugin->folder . 'views/ot-body.php'; ?>
		<?php require_once $this->plugin->folder . 'views/ot-behavior.php'; ?>
	</section>    
	<aside>
		<?php require_once $this->plugin->folder . 'views/ot-preview.php'; ?>
		<?php require_once $this->plugin->folder . 'views/ot-publish.php'; ?>
	</aside>
	</div>
</div>
