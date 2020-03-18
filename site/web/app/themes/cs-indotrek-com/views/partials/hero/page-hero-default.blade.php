{{-- {{ $content->backgroundMobile }} --}}
<section class="section hero hero--full-screen padding-y-xxl to-animate lazy" data-bg="url({{ $content->background }})"  data-theme="transparent">
    <div class="section__inner max-width-adaptive-sm">

        <!-- With CTA -->
        @if( is_object($content->cta) && $content->cta->type != 'none')
            <div class="hero__content text-center margin-top-n-xxl has-margin@md bg-inherit" data-theme="dark">
                <div class="text-component margin-bottom-md to-animate" data-animate="up">
                    <h1>{{ $content->title }}</h1>
                </div>
                
                <div class="flex flex-wrap flex-center flex-gap-sm to-animate" data-animate="up" data-delay=".2">
                    <a href="{{ $content->cta->url }}" class="btn btn--primary">{{ $content->cta->title }}</a>
                </div>
            </div>
        @else
            <div class="hero__content text-center position-relative bg-inherit" data-theme="dark">
                <div class="text-component margin-bottom-md to-animate" data-animate="up">
                    <h1>{{ $content->title }}</h1>
                </div>
            </div>
        @endif
    </div>
    <a href="#overview" class="js-smooth-scroll hero__scroll-down" data-duration="400">
        <img class="lazy" data-src="@image('scroll.svg')">  
    </a>
    <div class="section-divider lazy" data-bg="url(@image('hero-skewline.png'))"></div>
</section>