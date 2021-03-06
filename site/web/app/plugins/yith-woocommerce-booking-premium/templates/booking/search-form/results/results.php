<?php
/**
 * Booking Search Form Results Template
 *
 * Shows booking search form results
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/booking/search-form/results/results.php.
 *
 * @var WP_Query $products
 * @var array    $booking_request
 * @var int      $current_page
 * @var array    $product_ids
 */

!defined( 'YITH_WCBK' ) && exit;
?>

<?php do_action( 'yith_wcbk_booking_before_search_form_results' ); ?>

<?php if ( $products->have_posts() ) : ?>

    <ul class="yith-wcbk-search-form-result-products">

        <?php wc_get_template( 'booking/search-form/results/results-list.php', compact( 'products', 'booking_request' ), '', YITH_WCBK_TEMPLATE_PATH ); ?>

    </ul>

    <?php
    $posts_per_page = apply_filters( 'yith_wcbk_ajax_search_booking_products_posts_per_page', 12 );
    $last_page      = $posts_per_page > 0 ? ceil( count( $product_ids ) / $posts_per_page ) : 0;
    if ( $last_page > 1 ):
        ?>

        <div class="yith-wcbk-search-form-results-show-more"
             data-page="<?php echo $current_page ?>"
             data-product-ids='<?php echo esc_attr( json_encode( $product_ids ) ) ?>'
             data-booking-request='<?php echo esc_attr( json_encode( $booking_request ) ) ?>'
             data-last-page='<?php echo $last_page ?>'
        ><?php _e( 'Show more results...', 'yith-booking-for-woocommerce' ) ?></div>
    <?php endif; ?>

<?php endif; ?>

<?php do_action( 'yith_wcbk_booking_after_search_form_results' ); ?>
