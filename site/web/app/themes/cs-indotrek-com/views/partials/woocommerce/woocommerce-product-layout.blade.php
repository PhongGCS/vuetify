@php //do_action( 'woocommerce_before_main_content' ); @endphp
@php while ( have_posts() ) : the_post(); @endphp
	@php wc_get_template_part( 'content', 'single-product' ); @endphp
@php endwhile;@endphp
@php //do_action( 'woocommerce_after_main_content' ); @endphp