<?php
/**
 * Plugin Name: CS Admin URI Rewrite
 * Plugin URI: 
 * Description: Changes the Admin URI from /wp-admin to anything defined in the WP_ADMIN_SLUG constant. Does not work with WP_MULTISITE.
 * Version: 1.0.0
 * Author: Conceptual Studio
 * Author URI: https://conceptual.studio/
 * License: Proprietary
 */

if (defined('MULTISITE') && MULTISITE == true)
	return; // this does not work properly on multisite installation
	
	
add_action( 'plugins_loaded', 'my_plugins_loaded', 9999 );
add_action( 'wp_loaded', 'my_wp_loaded' );

add_filter( 'site_url', 'my_site_url', 10, 4 );
add_filter( 'network_site_url', 'my_network_site_url', 10, 3 );
add_filter( 'wp_redirect', 'my_wp_redirect', 10, 2 );
add_filter( 'site_option_welcome_email', 'welcome_email' );


function use_trailing_slashes() {

	return ( '/' === substr( get_option( 'permalink_structure' ), - 1, 1 ) );

}

function my_user_trailingslashit( $string ) {

	return use_trailing_slashes() ? trailingslashit( $string ) : untrailingslashit( $string );

}

function wp_template_loader() {

	global $pagenow;

	$pagenow = 'index.php';

	if ( ! defined( 'WP_USE_THEMES' ) ) {

		define( 'WP_USE_THEMES', true );

	}

	wp();

	if ( $_SERVER['REQUEST_URI'] === my_user_trailingslashit( str_repeat( '-/', 10 ) ) ) {

		$_SERVER['REQUEST_URI'] = my_user_trailingslashit( '/wp-login-php/' );

	}

	require_once( ABSPATH . WPINC . '/template-loader.php' );

	die;

}

function new_login_slug() {
	return WP_ADMIN_SLUG;
}

function new_login_url( $scheme = null ) {

	if ( get_option( 'permalink_structure' ) ) {

		return my_user_trailingslashit( home_url( '/', $scheme ) . new_login_slug() );

	} else {

		return home_url( '/', $scheme ) . '?' . new_login_slug();

	}

}



function my_plugins_loaded() {

	global $pagenow, $wp_login_php;

	if ( ! is_multisite()
		 && ( strpos( $_SERVER['REQUEST_URI'], 'wp-signup' ) !== false
			  || strpos( $_SERVER['REQUEST_URI'], 'wp-activate' ) ) !== false ) {

		wp_die( __( 'This feature is not enabled.', 'wpserveur-hide-login' ) );

	}

	$request = parse_url( $_SERVER['REQUEST_URI'] );

	if ( ( strpos( rawurldecode( $_SERVER['REQUEST_URI'] ), 'wp-login.php' ) !== false
		   || untrailingslashit( $request['path'] ) === site_url( 'wp-login', 'relative' ) )
		 && ! is_admin() ) {

		$wp_login_php = true;

		$_SERVER['REQUEST_URI'] = my_user_trailingslashit( '/' . str_repeat( '-/', 10 ) );

		$pagenow = 'index.php';

	} elseif ( untrailingslashit( $request['path'] ) === home_url( new_login_slug(), 'relative' )
			   || ( ! get_option( 'permalink_structure' )
					&& isset( $_GET[ new_login_slug() ] )
					&& empty( $_GET[ new_login_slug() ] ) ) ) {

		$pagenow = 'wp-login.php';

	}

}

function my_wp_loaded() {

	global $pagenow, $wp_login_php;

	if ( is_admin() && ! is_user_logged_in() && ! defined( 'DOING_AJAX' ) && $pagenow !== 'admin-post.php' ) {
		header("HTTP/1.0 404 Not Found");
		//wp_safe_redirect( home_url( '/404' ) );
		die();
	}

	$request = parse_url( $_SERVER['REQUEST_URI'] );

	if ( $pagenow === 'wp-login.php'
		 && $request['path'] !== my_user_trailingslashit( $request['path'] )
		 && get_option( 'permalink_structure' ) ) {

		wp_safe_redirect( my_user_trailingslashit( new_login_url() )
						  . ( ! empty( $_SERVER['QUERY_STRING'] ) ? '?' . $_SERVER['QUERY_STRING'] : '' ) );

		die;

	} elseif ( $wp_login_php ) {

		if ( ( $referer = wp_get_referer() )
			 && strpos( $referer, 'wp-activate.php' ) !== false
			 && ( $referer = parse_url( $referer ) )
			 && ! empty( $referer['query'] ) ) {

			parse_str( $referer['query'], $referer );

			if ( ! empty( $referer['key'] )
				 && ( $result = wpmu_activate_signup( $referer['key'] ) )
				 && is_wp_error( $result )
				 && ( $result->get_error_code() === 'already_active'
					  || $result->get_error_code() === 'blog_taken' ) ) {

				wp_safe_redirect( new_login_url()
								  . ( ! empty( $_SERVER['QUERY_STRING'] ) ? '?' . $_SERVER['QUERY_STRING'] : '' ) );

				die;

			}

		}

		wp_template_loader();

	} elseif ( $pagenow === 'wp-login.php' ) {
		global $error, $interim_login, $action, $user_login;

		if ( is_user_logged_in() && ! isset( $_REQUEST['action'] ) ) {
			wp_safe_redirect( admin_url() );
			die();
		}

		@require_once ABSPATH . 'wp-login.php';

		die;

	}

}

function my_site_url( $url, $path, $scheme, $blog_id ) {

	return filter_wp_login_php( $url, $scheme );

}

function my_network_site_url( $url, $path, $scheme ) {

	return filter_wp_login_php( $url, $scheme );

}

function my_wp_redirect( $location, $status ) {

	return filter_wp_login_php( $location );

}

function filter_wp_login_php( $url, $scheme = null ) {

	if ( strpos( $url, 'wp-login.php' ) !== false ) {

		if ( is_ssl() ) {

			$scheme = 'https';

		}

		$args = explode( '?', $url );

		if ( isset( $args[1] ) ) {

			parse_str( $args[1], $args );

			$url = add_query_arg( $args, new_login_url( $scheme ) );

		} else {

			$url = new_login_url( $scheme );

		}

	}

	return $url;

}

function welcome_email( $value ) {

	return $value = str_replace( 'wp-login.php', trailingslashit( WP_ADMIN_SLUG ), $value );

}