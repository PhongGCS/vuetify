@extends('layouts/page')

@section('content')
  @include("partials.pages.tour-detail.hero", ["content" => $tour->tourHero])
  <section class="section section--overview-tour">
    <div class="section__inner">
        <nav class="s-tabs">
            <ul class="s-tabs__list">
                <li><a href="#overview" class="js-smooth-scroll" data-duration="400">{{ __('Overview', 'indotrek') }}</a></li>
                <li><a href="#details" class="js-smooth-scroll" data-duration="400">{{ __('Details', 'indotrek') }}</a></li>
                <li><a href="#itinerary" class="js-smooth-scroll" data-duration="400">{{ __('Itinerary', 'indotrek') }}</a></li>
                <li><a href="#gallery" class="js-smooth-scroll" data-duration="400">{{ __('Gallery', 'indotrek') }}</a></li>
            </ul>
        </nav>
        <div class="grid grid-gap-lg padding-top-md" id="overview">
            <div class="col-8@md">
              @include("partials.pages.tour-detail.overview", ["content" => $tour->tourOverview])
              @include("partials.pages.tour-detail.detail", ['tour' => $tour])
              @include("partials.pages.tour-detail.itinerary", ["content" => $tour->tourItinerary])
            </div>
            <div class="col-4@md">
            {{-- @php echo do_action("yith_wcbk_booking_add_to_cart_form"); @endphp --}}
                {{-- <tour-booking-form /> --}}
                @if(!empty($tour->isPublic))
                  @include("partials.woocommerce.woocommerce-product-layout")
                @endif
                <div class="margin-top-lg">
                  <p class="margin-bottom-xs"> {{ __('Want to make this tour private', 'indotreck') }}</p>
                  <a href="{{ get_permalink(PRIVATE_TOUR_ID) }}" class="btn btn--outline"> {{ __('ENQUIRE', 'indotreck') }} </a>
                </div>
            </div>
        </div>
    </div>
  </section>
  @include("partials.core.gallery-modal-slider", ["content" => $tour->photosGallery])
  @include("partials.pages.tour-detail.related", ["content" => $tour->getRelatedTour()])


@endsection
@section('footerScripts')
@endsection