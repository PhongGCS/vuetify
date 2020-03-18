<?php 
// remove_action("woocommerce_before_main_content", "woocommerce_breadcrumb", 20);

remove_action("woocommerce_single_product_summary", "woocommerce_template_single_title", 5);
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_rating", 10);
// remove_action("woocommerce_single_product_summary", "woocommerce_template_single_price", 10);
// remove_action("woocommerce_single_product_summary", "woocommerce_template_single_excerpt", 20);
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_add_to_cart", 30);
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_meta", 40);
remove_action("woocommerce_single_product_summary", "woocommerce_template_single_sharing", 50);

remove_action("woocommerce_before_single_product_summary", "woocommerce_show_product_images", 20);
remove_action("woocommerce_before_single_product_summary", "woocommerce_show_product_sale_flash", 10);
remove_action("woocommerce_before_single_product_summary", "woocommerce_show_product_images", 20);
remove_action("woocommerce_before_single_product_summary", "woocommerce_upsell_display", 15);
remove_action("woocommerce_before_single_product_summary", "woocommerce_output_related_products", 20);

remove_action("woocommerce_after_single_product_summary", "woocommerce_output_product_data_tabs", 10);
remove_action("woocommerce_after_single_product_summary", "woocommerce_upsell_display", 15);
remove_action("woocommerce_after_single_product_summary", "woocommerce_output_related_products", 20);


add_filter( 'woocommerce_register_post_type_product', 'cs_change_name_product_to_tour' );

function cs_change_name_product_to_tour( $args ){
    $labels = array(
        'name'               => __( 'Tour', 'indotrek' ),
        'singular_name'      => __( 'Tour', 'indotrek' ),
        'menu_name'          => __( 'Tours', 'indotrek' ),
        'add_new'            => __( 'Add Tour', 'indotrek' ),
        'add_new_item'       => __( 'Add New Tour', 'indotrek' ),
        'edit'               => __( 'Edit Tour', 'indotrek' ),
        'edit_item'          => __( 'Edit Tour', 'indotrek' ),
        'new_item'           => __( 'New Tour', 'indotrek' ),
        'view'               => __( 'View Tour', 'indotrek' ),
        'view_item'          => __( 'View Tour', 'indotrek' ),
        'search_items'       => __( 'Search Tours', 'indotrek' ),
        'not_found'          => __( 'No Tours found', 'indotrek' ),
        'not_found_in_trash' => __( 'No Tours found in trash', 'indotrek' ),
        'parent'             => __( 'Parent Tour', 'indotrek' )
    );

    $args['labels'] = $labels;
    $args['description'] = __( 'This is where you can add new tours to your store.', 'indotrek' );
    return $args;
}


add_action("destination_edit_form", "cs_edit_acf_taxonomy");

function cs_edit_acf_taxonomy ($tag) {
    if(!empty($tag->parent)) {
        echo '<script type="text/javascript">
            jQuery(document).ready(function(){
                let fieldCountry = jQuery(".acf-field-5e3e343c07ce5");
                fieldCountry.parent().css("display", "none");
            });
        </script>';
    }else {
        echo '<script type="text/javascript">
            jQuery(document).ready(function(){
                let fieldCity = jQuery(".acf-field-5e3e4ab6d27a7");
                fieldCity.parent().css("display", "none");
            });
        </script>';
    }
}

add_action("destination_add_form_fields", "cs_new_acf_taxonomy");
function cs_new_acf_taxonomy() {
        echo '<script type="text/javascript">
            jQuery(document).ready(function(){
                let fieldCountry = jQuery("#acf-term-fields");
                fieldCountry.css("display", "none");
            });
        </script>';
}

add_filter( 'woocommerce_add_to_cart_validation', 'cs_only_one_in_cart', 99, 2 );
  
function cs_only_one_in_cart( $passed, $added_product_id ) {
   wc_empty_cart();
   return $passed;
}