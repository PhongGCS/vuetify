@extends('layouts/page')

@section('content')
<section class="section">
    <div class="section__inner">
        <div class="width-100%">
            @if (!is_wc_endpoint_url( 'order-received' ))
                <h1 class="text-xl margin-bottom-xxxs">{{ get_the_title() }}</h1>
            @endif
            {{-- @if(is_cart() && WC()->cart->get_cart_contents_count() != 0) 
                @php( wp_redirect(wc_get_checkout_url())  )
            @elseif(is_cart() && WC()->cart->get_cart_contents_count() == 0)
                @php( wp_redirect(get_home_url())  )
            @endif --}}
            {!! apply_filters('the_content', get_post_field('post_content', get_the_ID())) !!}
        </div>
    </div>
</section>
@endsection

@section('footerScripts')
@endsection