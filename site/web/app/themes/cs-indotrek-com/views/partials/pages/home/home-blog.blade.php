@php
    //vomit($content);
@endphp


<section class="section section--blog-listing to-animate" data-animate="up">
    <div class="section__inner">
        <div class="grid grid-gap-md items-end">
            <div class="col-6@md">
                <div class="max-width-500">
                    <span class="section__label">{{ $content->caption  }}</span>
                    <h1 class="text-xl">{{ $content->title  }}</h1>
                    <span class="section__divider">
                        <img src="/img/section-divider.svg" alt="">
                    </span>
                    <p>{{ $content->description }}</p>
                </div>
            </div>
                <div class="col-6@md">
                    <div class="flex flex-gap-sm justify-end@md">
                        <a class="btn btn--outline" href="{{ get_permalink(BLOG_ID) }}">{{ __("Explore more", "indotrek") }}</a>
                    </div>
                </div>
        </div>
        <div class="text-component margin-y-md">
            <hr>
        </div>
        <div class="grid grid-gap-md">
            @if ( !empty($content->blogList) && is_array($content->blogList) && count($content->blogList) )
                @foreach ($content->blogList as $item)
                <div class="col-6@xs">
                    <blog-card :data="{{ json_encode($item) }}" />
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>