@php
   $cityRelated = $destination->getRelatedCity();
@endphp
@if ( !empty($cityRelated) && is_array($cityRelated) && count($cityRelated) )
<section class="section section--destination-recommend-listing to-animate" data-animate="up">
    <div class="section__inner">
        <div class="grid grid-gap-md items-end">
            <div class="col-6@md">
                <div class="max-width-500">
                    <span class="section__label">{{ __('OTHER PLACES YOU MAY LIKE', 'indotrek')  }}</span>
                    <h1 class="text-xl sr-only">{{ __('OTHER PLACES YOU MAY LIKE', 'indotrek')  }}</h1>
                </div>
            </div>
        </div>
        <div class="grid grid-gap-md margin-top-md">
              @foreach ($cityRelated as $item)
                <div class="col-6@xs col-3@lg">
                    <!-- Card -->
                    <destination-card 
                    :data="{{ json_encode($item) }}"/>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif