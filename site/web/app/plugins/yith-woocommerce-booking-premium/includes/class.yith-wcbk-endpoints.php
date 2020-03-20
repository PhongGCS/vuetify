<?php
!defined( 'YITH_WCBK' ) && exit; // Exit if accessed directly

if ( !class_exists( 'YITH_WCBK_Endpoints' ) ) {
    /**
     * Class YITH_WCBK_Enpoints
     * handle Booking endpoints
     *
     * @author Leanza Francesco <leanzafrancesco@gmail.com>
     */
    class YITH_WCBK_Endpoints {

        /** @var array endpoints */
        public $endpoints = array();

        /** @var YITH_WCBK_Endpoints */
        private static $_instance;

        /**
         * Singleton implementation
         *
         * @return YITH_WCBK_Endpoints
         */
        public static function get_instance() {
            return !is_null( self::$_instance ) ? self::$_instance : self::$_instance = new self();
        }

        /**
         * YITH_WCBK_Endpoints constructor.
         */
        private function __construct() {
            $this->_init_vars();

            add_action( 'init', array( $this, 'add_endpoints' ) );
            add_filter( 'query_vars', array( $this, 'add_query_vars' ), 0 );

            add_filter( 'woocommerce_account_menu_items', array( $this, 'add_booking_endpoint_in_myaccount_menu' ) );
            add_filter( 'the_title', array( $this, 'get_endpoint_title' ), 10, 2 );

            // Endpoint Content
            foreach ( $this->endpoints as $key => $value ) {
                if ( !empty( $value ) ) {
                    add_action( 'woocommerce_account_' . $value . '_endpoint', array( $this, 'show_endpoint' ) );
                }
            }

            // Endpoint Settings
            add_filter( 'woocommerce_account_settings', array( $this, 'add_booking_endpoint_settings' ) );
            add_action( 'woocommerce_update_options_account', array( $this, 'add_endpoints' ) );
        }

        /**
         * init class vars
         */
        private function _init_vars() {
            $this->endpoints = array(
                'bookings'     => get_option( 'woocommerce_myaccount_bookings_endpoint', 'bookings' ),
                'view-booking' => get_option( 'woocommerce_myaccount_view_booking_endpoint', 'view-booking' )
            );

        }

        /**
         * Add Booking Endpoint settings in WooCommerce endpoint settings
         *
         * @param $settings
         * @return array
         */
        public function add_booking_endpoint_settings( $settings ) {

            $booking_endpoint_settings = array(
                array(
                    'title' => __( 'Booking endpoints', 'yith-booking-for-woocommerce' ),
                    'type'  => 'title',
                    'id'    => 'yith_wcbk_endpoint_options' ),

                array(
                    'title'    => __( 'Bookings', 'yith-booking-for-woocommerce' ),
                    'desc'     => __( 'Endpoint for the My Account &rarr; Bookings page', 'yith-booking-for-woocommerce' ),
                    'id'       => 'woocommerce_myaccount_bookings_endpoint',
                    'type'     => 'text',
                    'default'  => 'bookings',
                    'desc_tip' => true,
                ),

                array(
                    'title'    => __( 'View booking', 'yith-booking-for-woocommerce' ),
                    'desc'     => __( 'Endpoint for the My Account &rarr; View Booking page', 'yith-booking-for-woocommerce' ),
                    'id'       => 'woocommerce_myaccount_view_booking_endpoint',
                    'type'     => 'text',
                    'default'  => 'view-booking',
                    'desc_tip' => true,
                ),
                array( 'type' => 'sectionend', 'id' => 'yith_wcbk_endpoint_options' ),
            );

            return array_merge( $settings, $booking_endpoint_settings );
        }

        /**
         * Add the new endpoints to WP
         */
        public function add_endpoints() {
            $this->_init_vars();
            foreach ( $this->endpoints as $key => $value ) {
                if ( !empty( $value ) ) {
                    add_rewrite_endpoint( $value, EP_ROOT | EP_PAGES );
                }
            }
        }

        /**
         * Add new query var.
         *
         * @param array $vars
         * @return array
         */
        public function add_query_vars( $vars ) {
            foreach ( $this->endpoints as $key => $value ) {
                if ( !empty( $value ) ) {
                    $vars[] = $value;
                }
            }

            return $vars;
        }

        /**
         * Add booking in My Account Nav menu
         *
         * @param $items
         * @return array
         */
        public function add_booking_endpoint_in_myaccount_menu( $items ) {
            $a = array_slice( $items, 0, 1, true );
            $b = array_slice( $items, 1 );

            $bookings_endpoint = $this->get_endpoint( 'bookings' );

            $endpoints_to_add = array(
                $bookings_endpoint => __( 'Bookings', 'yith-booking-for-woocommerce' )
            );

            $items = array_merge( $a, $endpoints_to_add, $b );

            return $items;
        }

        /**
         * get endpoint
         *
         * @param $key
         * @return mixed
         */
        public function get_endpoint( $key ) {
            return !empty( $this->endpoints[ $key ] ) ? $this->endpoints[ $key ] : $key;
        }

        /**
         * Get the current endpoint
         *
         * @return bool|int|string
         */
        public function get_current_endpoint() {
            global $wp;

            if ( is_admin() || !is_main_query() || !in_the_loop() || !is_account_page() ) {
                return false;
            }

            $current_endpoint = false;
            foreach ( $this->endpoints as $endpoint_id => $endpoint ) {
                if ( isset( $wp->query_vars[ $endpoint ] ) ) {
                    $current_endpoint = $endpoint_id;
                    break;
                }
            }

            return $current_endpoint;
        }

        /**
         * Get the title of the current endpoint
         *
         * @param $title
         * @param $id
         * @return string
         */
        public function get_endpoint_title( $title, $id = 0 ) {
            if ( $id != wc_get_page_id( 'myaccount' ) )
                return $title;

            global $wp;

            $endpoint = $this->get_current_endpoint();

            switch ( $endpoint ) {
                case 'bookings':
                    $endpoint = $this->get_endpoint( 'bookings' );
                    if ( !empty( $wp->query_vars[ $endpoint ] ) ) {
                        $title = sprintf( __( 'Bookings (page %d)', 'yith-booking-for-woocommerce' ), intval( $wp->query_vars[ $endpoint ] ) );
                    } else {
                        $title = __( 'Bookings', 'yith-booking-for-woocommerce' );
                    }
                    break;
                case 'view-booking':
                    $endpoint = $this->get_endpoint( 'view-booking' );
                    $booking  = yith_get_booking( $wp->query_vars[ $endpoint ] );
                    $title    = ( $booking ) ? $booking->get_name() : '';
                    break;
            }

            return $title;
        }

        /**
         * Plugin install action.
         * Flush rewrite rules to make our custom endpoint available.
         */
        public static function install() {
            flush_rewrite_rules();
        }

        /**
         * Show the endpoint content
         */
        public function show_endpoint() {
            global $wp;

            $endpoint = $this->get_current_endpoint();

            switch ( $endpoint ) {
                case 'bookings':
                    $user_id  = get_current_user_id();
                    $bookings = YITH_WCBK()->booking_helper->get_bookings_by_user( $user_id, 'bookings' );
                    $args     = array(
                        'bookings'     => $bookings,
                        'has_bookings' => !!$bookings
                    );
                    wc_get_template( 'myaccount/bookings.php', $args, '', YITH_WCBK_TEMPLATE_PATH );
                    break;
                case 'view-booking':
                    $endpoint   = $this->get_endpoint( 'view-booking' );
                    $booking_id = $wp->query_vars[ $endpoint ];
                    $booking    = yith_get_booking( $booking_id );

                    if ( !$booking || !$booking->is_valid() || !current_user_can( 'view_booking', $booking_id ) ) {
                        echo '<div class="woocommerce-error">' . esc_html__( 'Invalid booking.', 'yith-booking-for-woocommerce' ) . ' <a href="' . esc_url( wc_get_account_endpoint_url( $this->get_endpoint( 'bookings' ) ) ) . '" class="wc-forward">' . esc_html__( 'View your bookings', 'yith-booking-for-woocommerce' ) . '</a></div>';

                        return;
                    }
                    $args = array(
                        'booking'    => $booking,
                        'booking_id' => $booking_id
                    );
                    wc_get_template( 'myaccount/view-booking.php', $args, '', YITH_WCBK_TEMPLATE_PATH );
                    break;
            }
        }
    }
}