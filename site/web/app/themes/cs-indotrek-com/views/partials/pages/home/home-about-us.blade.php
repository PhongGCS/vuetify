@php
    //vomit($content);
@endphp
<section class="section section--overview-home to-animate" data-animate="up" id="overview">
    <div class="section__inner">
        <div class="grid grid-gap-md">
            <div class="col-8@md">
                <div class="grid grid-gap-md">
                    <div class="col-6@sm">
                        <div class="max-width-500">
                            <span class="section__label">{{ $content->caption  }}</span>
                            <h1 class="text-xl">{{ $content->title }}</h1>
                            <span class="section__divider">
                                <img class="lazy" data-src="@image('section-divider.svg')" alt="">
                            </span>
                        </div>
                    </div>
                    <div class="col-6@sm">
                        <div class="display@xs">
                            <img class="block margin-left-auto lazy"  data-src="{{ $content->image }}" aria-hidden="true" alt="Man on bicycle">                    
                            <div class="line-bicycle" >
                                <div class="ratio">
                                    <svg class="ratio__content" width="770" height="78" viewBox="0 0 770 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M769 1C761.722 16.7433 723.188 52.6379 627.274 70.2704C538.408 86.6072 395.534 70.2704 299.007 52.428C197.775 33.716 111.316 34.5856 1 52.428" stroke="#F8981C" stroke-width="2" stroke-dasharray="2 2"/>
                                    </svg>    
                                </div>
                            </div>
                            
                            <div class="mountain-bicycle-1 to-animate" data-animate="left" data-delay=".2">
                                <div class="ratio">
                                    <img class="ratio__content lazy" data-src="@image('mountain-bicycle-1.svg')">
                                </div>
                            </div>
                            <div class="mountain-bicycle-2 to-animate" data-animate="left">
                                <div class="ratio">
                                    <img class="ratio__content lazy" data-src="@image('mountain-bicycle-2.svg')">
                                </div>
                            </div>
                            <div class="mountain-bicycle-3 to-animate" data-animate="right" data-delay=".4">
                                <div class="ratio">
                                    <img class="ratio__content lazy" data-src="@image('mountain-bicycle-3.svg')">
                                </div>
                            </div>
                        </div>
                        <div class="ratio hide@xs">
                            <img class="ratio__content lazy" data-src="{{ $content->imageMobile }}" alt="Man on bicycle">                    
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4@md">
                <div class="text-component">
                    <p>{!! $content->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>