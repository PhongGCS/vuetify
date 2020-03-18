@php
    //vomit($content);
@endphp


<section class="section section--home-tours">
    <div class="section__bg" data-bg="url(@image('home-tour-bg.jpg'))">
    </div>
    <div class="section__inner">
        <div class="grid grid-gap-md">
            <div class="col-4@md to-animate" data-animate="up">
                <div class="max-width-500">
                    <span class="section__label">{{ $content->caption  }}</span>
                    <h1 class="text-xl">{{ $content->title }}</h1>
                    <span class="section__divider">
                        <img src="@image('section-divider.svg')" alt="">
                    </span>
                    <div class="text-component margin-top-sm">
                        <p>{!! $content->description !!}</p>
                    </div>
                    @if( is_object($content->cta) && $content->cta->type != 'none')
                      <a href='{{ $content->cta->url }}' class='btn btn--outline margin-top-md'>{{ $content->cta->title }}</a>
                    @endif
                </div>
            </div>
            <div class="col-8@md">
                <div class="text-component">
                    <div class="grid grid-gap-md">
                        @if ( !empty($content->postList) && is_array($content->postList) && count($content->postList) )
                          @foreach ($content->postList as $item)
                            <div class="col-6@xs to-animate"  data-animate="up" data-delay=".{{ $loop->index}}">
                                <tour-card :data="{{ json_encode($item) }}" />
                            </div>
                          @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>