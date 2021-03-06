<?php
/**
 * Widget Booking Form
 *
 * @author        Leanza Francesco <leanzafrancesco@gmail.com>
 *
 * @var WC_Product_Booking $product
 */

!defined( 'ABSPATH' ) && exit; // Exit if accessed directly
?>

<div class="yith_wcbk_widget_booking_form_mouse_trap"></div>
<span class="yith_wcbk_widget_booking_form_close"><?php yith_wcbk_print_svg( 'no' ) ?></span>

<div id="product-<?php echo $product->get_id() ?>" class="product type-product yith-booking yith-wcbk-widget-booking-form">
    <div class="yith_wcbk_widget_booking_form_head">
        <?php
        /**
         * yith_wcbk_widget_booking_form_head hook.
         *
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_rating - 20
         */
        do_action( 'yith_wcbk_widget_booking_form_head' );
        ?>
    </div><!-- .yith_wcbk_widget_booking_form_head -->

    <div class="yith_wcbk_widget_booking_form_summary">
        <?php
        do_action( 'yith_wcbk_widget_booking_form_before_add_to_cart_form' );

        do_action( 'yith_wcbk_booking_add_to_cart_form' );

        do_action( 'yith_wcbk_widget_booking_form_after_add_to_cart_form' );
        ?>
    </div><!-- .yith_wcbk_widget_booking_form_summary -->
</div>