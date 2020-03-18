
@if ( !empty($content) && is_array($content) && count($content) )
<section class="section section--destination-recommend-listing to-animate" data-animate="up">
    <div class="section__inner">
        <div class="grid grid-gap-md items-end">
            <div class="col-6@md">
                <div class="max-width-500">
                    <span class="section__label">{{ __('OTHER TOURS YOU MAY BE INTERESTED IN', 'indotrek')  }}</span>
                    <h1 class="text-xl sr-only">{{ __('OTHER TOURS YOU MAY BE INTERESTED IN', 'indotrek')  }}</h1>
                </div>
            </div>
        </div>
        <div class="grid grid-gap-md margin-top-sm">
              @foreach ($content as $item)
                <div class="col-4@sm">
                    <tour-card :data="{{ json_encode($item) }}" />
                </div>
              @endforeach
        </div>
    </div>
</section>
@endif