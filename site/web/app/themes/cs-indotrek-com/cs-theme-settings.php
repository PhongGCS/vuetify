<?php
use ConceptualStudio\Models\Core;


add_action( 'admin_menu', 'register_my_page' );
function register_my_page() {
	add_menu_page( 'Conceptual', 'Conceptual', 'edit_others_posts', 'conceptual-menu',
	function() { echo ""; }, 'dashicons-admin-site', 0 );
}

add_action('init', function(){
	// Add ACF Theme Settings
	if( function_exists('acf_add_options_page') ) {

	  acf_add_options_page(array(
		'page_title'  => 'Conceptual Theme Settings',
		'menu_title'  => 'Theme Settings',
		'menu_slug'   => 'theme-general-settings',
		'parent_slug' => 'conceptual-menu',
		'capability'  => 'edit_posts',
		'redirect'    => false
	  ));
	}

});

function cs_maintenance_mode() {
	global $pagenow;
	$showUnderMaintenance = false;
	if ($pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin()) {

		// test if ACF is installed
		if (function_exists('get_field')) {
			// check the theme settings first
			$maintenanceMode = get_field('maintenance_mode', 'option');
			if ($maintenanceMode['activated']) {
				header($_SERVER["SERVER_PROTOCOL"] . ' 503 Service Temporarily Unavailable', true, 503);
				header('Content-Type: text/html; charset=utf-8');
				if (file_exists(get_template_directory() . '/views/under-maintenance.php')) {
					require_once(get_template_directory() . '/views/under-maintenance.php');
				}
				die();
			}
		}
	}
}

add_action( 'wp_loaded', 'cs_maintenance_mode' );
add_action( 'enable_maintenance_mode', 'cs_maintenance_mode' );

// *** DO NOT EDIT UNLESS YOU KNOW WHAT YOU DO *** 
// *** Handle menu item highlighting -- highlight a post type link once a taxonomy page is displayed ***
add_action( 'parent_file', 'menu_highlight' );
function menu_highlight( $parent_file ) {
	global $current_screen;


	// make sure that the parent post type is highlighted in the menu once the child taxonomy page is displayed
	$taxonomy = $current_screen->taxonomy;
	$taxonomies = get_taxonomies( array ("_builtin" => false), 'objects' );

	if ( isset($taxonomies[$taxonomy]) ) {
		$objectType = $taxonomies[$taxonomy]->object_type;
		if (count($objectType) > 0)
			$parent_file = 'conceptual-menu';
	}

	return $parent_file;
}



// *** Add custom content to the page header - add taxonomy links on custom post pages ***
add_action( 'load-edit.php', function(){

   $screen = get_current_screen();
   $postTypes = get_post_types( array( "_builtin" => false ), 'objects' ); // get all custom post types


   // Taxonomy list
   // we want to add this only on the screen showing a custom post type
   foreach ($postTypes as $postObj) {
	if ($screen->post_type == $postObj->name) {
		// okay, this is a custom post type
		// let's check if there are any taxonomies associated
		$taxonomies = get_object_taxonomies($postObj->name, 'objects');

		if ($taxonomies && count($taxonomies) > 0) {
			// okay we have something to show
			add_action( 'admin_notices', function(){
				$screen = get_current_screen();
				$taxonomies = get_object_taxonomies($screen->post_type, 'objects');

				echo "<div id='wpses-warning' class='notice notice-info'><p><strong>Taxonomies: </strong>";
				foreach ($taxonomies as $taxonomy) {
					echo "<a href='edit-tags.php?taxonomy=".$taxonomy->name."'>".$taxonomy->label."</a> &nbsp;";
				}


				echo "</p></div>";

			});
		}
	}
   }
});

// *** Remove WP version from the HTML Meta ***
function cs_remove_wp_version() {
	return '';
}
add_filter('the_generator', 'cs_remove_wp_version');




// *** Save Post: Mailer Server Diagnostics on the Theme Settings Page ***
function cs_acf_save_post() {
    $screen = get_current_screen();

    // check the name of the current screen
    if (strpos($screen->id, "theme-general-settings") == true) {
        // we're on the Theme Settings page, get the current data
        $mailing = get_field('mailing', 'options');
        if (isset($mailing) && is_array($mailing) && isset($mailing['mailer'])) {

            switch ($mailing['mailer']) {
                case 'amazon-ses':
                    // let's try to connect with the provided credentials
                    try {
                        $ses = new \Aws\Ses\SesClient([
                            'credentials' => new \Aws\Credentials\Credentials(
                                $mailing['amazon_ses_access_key_id'],
                                $mailing['amazon_ses_secret_key']
                            ),
                            'region' => $mailing['amazon_ses_region'],
                            'version' => '2010-12-01',
                        ]);


                        $result = $ses->listIdentities([
                            ]);
                        $mailing['connection_log'] = "Connection to the AWS SES was successful.\n\n";
                        $mailing['connection_log'] .= "Following domains and e-mail addresses can be used as a sender:\n";
                        foreach ($result->toArray()['Identities'] as $identity)
                            $mailing['connection_log'] .= "- ".$identity."\n";

                    }
                    catch( \Aws\Exception\AwsException $e )
                    {
                        $mailing['connection_log'] = "Could not connect to the AWS SES service. Please check your API keys and assigned privileges or try to hit Update to refresh this log.\n\n";
                        $mailing['connection_log'] .= "AWS Error: ".$e->getAwsErrorCode()."\n";
                        $mailing['connection_log'] .= "AWS Error Message: ".$e->getAwsErrorMessage();
                    }

                    update_field('mailing', $mailing, 'options');
                    break;
            }
        }
    }
}
add_action('acf/save_post', 'cs_acf_save_post', 20);


// #### jQuery - move to the footer and use the 3x version ####
add_action('wp_enqueue_scripts', function () {
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', [], null, true);
}, 5);



// #### Remove the Editor from the Content Pages ####
add_action( 'admin_init', 'hide_editor' );
 
function hide_editor() { 
    $post_id = @$_GET['post'] ? @$_GET['post'] : @$_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;
 
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
	
    if($template_file == 'Content-Page.php'){ // edit the template name
        remove_post_type_support('page', 'editor');
    }
}