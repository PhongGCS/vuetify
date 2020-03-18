@php
  //vomit($content);
@endphp

<section class="section section--single-article first-resize-gutter">
    <div class="section__inner">
        <div class="grid grid-gap-md items-end">
            <div class="col-6@md">
                <div class="max-width-500">
                    <span class="section__label">{{ $content->caption  }}</span>
                    <h1 class="text-xl">{{ $content->title  }}</h1>
                    <span class="section__divider">
                        <img src="@image('section-divider.svg')" alt="">
                    </span>
                    <p>{{ $content->description }}</p>
                </div>
            </div>
        </div>

        <articles-filter-listing
            :filter-list="{{ json_encode($content->filterList) }}"
            :items-list="{{ json_encode($content->postList) }}"
            :per-page="10"
            :init-show-items="10"
            :number-load-items="10"
        /> 
    </div>
</section>