@php
    //vomit($content);
@endphp


<section class="section section--home-contact-cta to-animate" data-animate="up">
    <div class="section__inner">
        <div class="text-component text-center max-width-600 margin-x-auto">
            <h1 class="text-xl">{{ $content->title }}</h1>
            <p>{{ $content->description }}</p>
            @if( is_object($content->cta) && $content->cta->type != 'none')
                <a href='{{ $content->cta->url }}' class='btn btn--outline margin-top-sm'>{{ $content->cta->title }}</a>
            @endif
        </div>
    </div>
    <div class="flex position-relative margin-top-n-xxl has-margin@md" style="z-index: -1;">
       <div class="col-12">
           <div class="ratio ratio--2:1">
               <img class="ratio__content lazy" data-src="{{ $content->image }}" alt="">
           </div>
       </div>
    </div>
</section>