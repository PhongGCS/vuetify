<?php
/**
 * Booking Search Form Single Result Title Template
 *
 * shows the single result product
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/booking/search-form/results/single/title.php.
 *
 * @var WC_Product_Booking $product
 * @var array              $booking_data
 */

!defined( 'ABSPATH' ) && exit; // Exit if accessed directly

global $product;
?>

<h3><?php echo $product->get_title() ?></h3>
