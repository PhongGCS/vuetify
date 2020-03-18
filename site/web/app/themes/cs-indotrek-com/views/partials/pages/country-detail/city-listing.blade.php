<section class="section section--destination-listing to-animate" data-animate="up" data-theme="light">
    <div class="section__inner">
        <div class="grid grid-gap-md items-end">
            <div class="col-6@md">
                <div class="max-width-500">
                    <span class="section__label">{{ __('Destinations', 'indotrek')  }}</span>
                    <h1 class="text-xl">{{ __('Destinations in ', 'indotrek'). $destination->title  }}</h1>
                    <span class="section__divider">
                        <img src="@image('section-divider.svg')" alt="">
                    </span>
                </div>
            </div>
        </div>
        <destinations-listing
            :items-list="{{ json_encode($destination->getCities()) }}"
            :init-show-items="8"
            :number-load-items="4"
        >
        </destinations-listing>
    </div>
</section>