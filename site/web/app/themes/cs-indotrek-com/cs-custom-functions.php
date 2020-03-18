<?php
define("BLOG_ID", 4);
define("CONTACT_ID", 474);
define("PRIVATE_TOUR_ID", 476);
define("TOURS_ID", 464);

function cs_get_menu_array($menu_slug = '') {
    $menu = array();
    if ($menu_slug == '' || $menu_slug == 'pages') {
        // return all the Pages
        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => 0,
            'parent' => -1,
            'exclude_tree' => '',
            'number' => '',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
        );
        $pages = get_pages($args);
        foreach ($pages as $m) {
            if ($m->post_parent == 0) {
                $menu[$m->ID] = array();
                $menu[$m->ID]['PostID'] = $m->ID;
                $menu[$m->ID]['ID'] = $m->ID;
                $menu[$m->ID]['title'] = $m->post_title;
                $menu[$m->ID]['url'] = get_permalink($m->ID);
                $menu[$m->ID]['children'] = array();
            }
        }
        $submenu = array();
        foreach ($pages as $m) {
            if ($m->post_parent) {
                $submenu[$m->ID] = array();
                $submenu[$m->ID]['PostID'] = $m->ID;
                $submenu[$m->ID]['ID'] = $m->ID;
                $submenu[$m->ID]['title'] = $m->post_title;
                $submenu[$m->ID]['url'] = get_permalink($m->ID);
                $menu[$m->post_parent]['children'][$m->ID] = $submenu[$m->ID];
            }
        }
    }
    else {
        $array_menu = wp_get_nav_menu_items($menu_slug);

        if (!$array_menu)
            return $menu;

        foreach ($array_menu as $m) {
            if (empty($m->menu_item_parent)) {
                $menu[$m->ID] = array();
                $menu[$m->ID]['PostID'] = $m->object_id;
                $menu[$m->ID]['ID'] = $m->ID;
                $menu[$m->ID]['title'] = $m->title;
                $menu[$m->ID]['url'] = $m->url;
                $menu[$m->ID]['children'] = array();
            }
        }
        $submenu = array();
        foreach ($array_menu as $m) {
            if ($m->menu_item_parent) {
                $submenu[$m->ID] = array();
                $submenu[$m->ID]['PostID'] = $m->object_id;
                $submenu[$m->ID]['ID'] = $m->ID;
                $submenu[$m->ID]['title'] = $m->title;
                $submenu[$m->ID]['url'] = $m->url;
                $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
            }
        }
    }
    return $menu;

}

register_taxonomy( 
    'destination',
    ['product', 'post', 'hotel'],
    array( 
        'hierarchical'  => true, 
        'label'         => __( 'Destinations','indotrek'), 
        'singular_name' => __( 'Destination', 'indotrek' ), 
        'rewrite'       => true, 
        'query_var'     => true 
    )
);

register_taxonomy( 
    'activity',
    ['product'],
    array( 
        'hierarchical'  => true, 
        'label'         => __( 'Activities','indotrek'), 
        'singular_name' => __( 'Activity', 'indotrek' ), 
        'rewrite'       => true, 
        'query_var'     => true 
    )
);

register_taxonomy( 
    'category-type',
    [],
    array( 
        'hierarchical'  => true, 
        'label'         => __( 'Category Type','indotrek'), 
        'singular_name' => __( 'Category Type', 'indotrek' ), 
        'rewrite'       => true, 
        'query_var'     => true 
    )
);

register_taxonomy( 
    'duration',
    ['product'],
    array( 
        'hierarchical'  => true, 
        'label'         => __( 'Duration','indotrek'), 
        'singular_name' => __( 'Duration', 'indotrek' ), 
        'rewrite'       => true, 
        'query_var'     => true 
    )
);


function getFilterItem($taxonomy) {
    $taxonomyObject = get_taxonomy($taxonomy);

    $filterItem = null;
    $arg = [
      'hide_empty'      => false,
      "taxonomy" => $taxonomy,
      "parent" => 0
    ];
    $categories = get_categories($arg);
    $filterItem['options'][] = [
      'value' => 'all',
      'label' => 'All'
    ];
    if ( !empty($categories) && is_array($categories) && count($categories) ){
        foreach ($categories as $item){
            $filterItem['options'][] = [
                "label" => $item->name,
                "value" => $item->slug,
            ];
        }
    }

    $filterItem['slug'] = $taxonomy;
    $filterItem['label'] = $taxonomyObject->label;

    return (object) $filterItem;
}

function getCategoryForSelected($taxonomy) {
    $taxonomyObject = get_taxonomy($taxonomy);

    $filterItem = null;
    $arg = [
      'hide_empty'      => false,
      "taxonomy" => $taxonomy,
      "parent" => 0
    ];
    $categories = get_categories($arg);
    if ( !empty($categories) && is_array($categories) && count($categories) ){
        foreach ($categories as $item){
            $filterItem[] = [
                "label" => $item->name,
                "value" => $item->name,
            ];
        }
    }

    $filterItem['slug'] = $taxonomy;
    $filterItem['label'] = $taxonomyObject->label;

    return (object) $filterItem;
}

add_action('admin_menu', 'cs_remove_sub_menus');

function cs_remove_sub_menus() {
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}

function cs_get_term_top_most_parent( $term, $taxonomy ) {
    // Start from the current term
    $parent  = get_term( $term, $taxonomy );
    // Climb up the hierarchy until we reach a term with parent = '0'
    while ( $parent->parent != '0' ) {
        $term_id = $parent->parent;
        $parent  = get_term( $term_id, $taxonomy);
    }
    return $parent;
}
add_filter( 'wp_calculate_image_srcset', '__return_false' );


add_action('woocommerce_before_order_notes', 'cs_custom_checkout_field');

function cs_custom_checkout_field($checkout){
    $attendee_count = getPersonsFromCart();

    // vomit($attendee_count);
    
    if($attendee_count > 0) {
        echo '<h3>' . __('Travellers information '). '</h3>';
        for($i = 1; $i <= $attendee_count; $i++ ) {
            echo '<div id="checkout_field_travel traveller">';
            echo '<h4>' . __('Traveller ') . $i . '</h4>';

            woocommerce_form_field('name_'.$i, 
                [
                    'type' => 'text',
                    'class' => ['form-row-first'],
                    'label' => __('Full name (as per passport)', 'indotreck') ,
                    'placeholder' => "",
                ],
            $checkout->get_value('name_'.$i)
            );


            woocommerce_form_field('nationality_'.$i, 
                [
                    'type' => 'text',
                    'class' => ['form-row-last'],
                    'label' => __('Nationality', 'indotreck') ,
                    'placeholder' => "",
                ],
            $checkout->get_value('nationality_'.$i)
            );

            woocommerce_form_field('dayOfBirth_'. $i, 
                [
                    'type' => 'text',
                    'class' => ['form-row-first'],
                    'label' => __('Day of birth', 'indotreck') ,
                    'placeholder' => "",
                ],
            $checkout->get_value('dayOfBirth_'. $i)
            );
            echo "<div class='form-row-last'>";
                woocommerce_form_field( 'gender_'.$i, array(
                    'type'          => 'select',
                    'class'         => ['form-row-first cs-selected'],
                    'label'         => __('Gender'),
                    'required'    => false,
                    'options'     => array(
                        'Male' => __('Male'),
                        'Female' => __('Female')
                    ),
                    'default' => 'Male'), 
                $checkout->get_value( 'gender_'.$i ));

                woocommerce_form_field('height_'.$i, 
                    [
                        'type' => 'text',
                        'class' => ['form-row-last'],
                        'label' => __('Height', 'indotreck') ,
                        'placeholder' => "",
                    ],
                $checkout->get_value('height_'.$i)
                );
            echo "</div>";

            echo '</div>';
        }
    }

    echo '<div id="user_link_hidden_checkout_field">
        <input type="hidden" class="input-hidden" name="attendee_count" id="attendee_count" value="' . $attendee_count . '">
    </div>';
}



add_action('woocommerce_checkout_update_order_meta', 'cs_custom_checkout_field_update_order_meta', 30, 1);

function cs_custom_checkout_field_update_order_meta($order_id){
    if(empty($_POST['attendee_count'])) {
        return;
    }
    $attendee_count = sanitize_text_field($_POST['attendee_count']);
    if($attendee_count > 0) {
        $whiteList = [
            "name" => "Name: ", "nationality" => "Nationality: ", "dayOfBirth" => "Day of Birth: ", "gender" => "Gender: ", "height" =>"Height: "
        ];
        $data = "";
        for($i = 1; $i <= $attendee_count; $i++ ) {
            foreach($whiteList as $key =>  $item) {
                $field = $key. "_".$i;
                if (!empty($_POST[$field]))  {
                    $data .= $item . sanitize_text_field($_POST[$field]). "|";
                }
            }
            $data .= "_____________________________________________|";
        }
        update_post_meta($order_id, 'travellers_information',sanitize_text_field($data));
    }
}


add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_custom_field_in_admin_order_meta', 10, 1 );
function display_custom_field_in_admin_order_meta($order){
    $string = get_post_meta( $order->get_id(), 'travellers_information', true );
    echo '<p><strong>'.__('Travellers Information').':</strong>  <br />' . str_replace("|", "<br />", $string). '</p>';
}

function getPersonsFromCart() {
    global $woocommerce;
    $items = $woocommerce->cart->get_cart();
    foreach($items as $item => $cart_item) { 
        $product_id = isset( $cart_item[ 'product_id' ] ) ? $cart_item[ 'product_id' ] : 0;
        if ( YITH_WCBK_Product_Post_Type_Admin::is_booking( $product_id ) ) {
            $booking_data = $cart_item[ 'yith_booking_data' ];
            $product = wc_get_product( $product_id );
            if ( $product->has_people() ) {
                return $booking_data['persons'];
            }
        }
    }
    return 0;
}



?>