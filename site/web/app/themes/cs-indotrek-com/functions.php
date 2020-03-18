<?php

if (!class_exists(\Stem\Core\Context::class)) {
    return;
}

include 'helpers.php';

/**
 * Create the context for this theme.
 *
 */
$context=\Stem\Core\Context::initialize(dirname(__FILE__));

/**
 * Setup functions
 */
$context->onSetup(function() use ($context) {
    define('ILAB_STEM_CONTENT_DIR',dirname(__FILE__));
    define('ILAB_STEM_CONTENT_URI', plugin_dir_url(__FILE__));

    register_activation_hook( __FILE__, function(){
        if (!class_exists('\Stem\Core\Context')) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            wp_die( __( 'Please install ILAB Stem App Framework for WordPress before activating this plugin.', 'stem-content' ) );
        }
    });

    if (!defined('WP_CLI')) {
        add_action('acf/include_field_types', function( $version ) {
            new \ILab\StemContent\ACF\FontAwesomeField();
            new \ILab\StemContent\ACF\CSSClassesField();
            new \ILab\StemContent\ACF\ContentTemplateField();
        });
    }

    add_filter('stem/additional_view_paths', function($paths) {
        $paths[] = ILAB_STEM_CONTENT_DIR.'/views';

        return $paths;
    });


    add_filter('ilab_s3_process_crop', function($size, $path, $file, $sizeMeta){
        return $sizeMeta;
    }, 10, 4);


    remove_shortcode('gallery');
    add_shortcode('gallery', function($atts) use ($context) {
        if (!isset($atts['ids'])) {
            return '';
        }

        $images = [];
        $ids = explode(',',$atts['ids']);
        foreach($ids as $id) {
            $images[] = $context->modelForPost(\WP_Post::get_instance(trim($id)));
        }

        return $context->ui->render('partials/content/post-gallery',['images' => $images]);
    });

    add_shortcode('stemimage', function($atts) use ($context) {
        if (!isset($atts['id'])) {
            return '';
        }


        $image = $context->modelForPost(\WP_Post::get_instance(trim($atts['id'])));

        if (!$image)
            return '';

        return '<div class="post-image">'.$image->img('post-image').'</div>';
    });
});

require_once("cs-theme-settings.php");
require_once("cs-custom-functions.php");
require_once("cs-woocommerce-functions.php");
require_once("cs-vue-functions.php");