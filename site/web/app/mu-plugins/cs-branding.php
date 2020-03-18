<?php
/**
 * Plugin Name: CS Branding
 * Plugin URI:
 * Description: Changes the logo and title on the wp-login page.
 * Version: 1.0.0
 * Author: Conceptual Studio
 * Author URI: https://conceptual.studio/
 * License: Proprietary
 */


function cs_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo wp_upload_dir()['baseurl']; ?>/cs-branding-uploads/site-login-logo.png);
	          height:100px;
            width:320px;
            background-size: 230px;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'cs_login_logo' );


function cs_login_logo_url() { return "https://conceptual.studio"; }
add_filter( 'login_headerurl', 'cs_login_logo_url' );

function cs_login_title() { return "Developed by Conceptual. Powered by WordPress."; }
add_filter( 'login_headertitle', 'cs_login_title' );
