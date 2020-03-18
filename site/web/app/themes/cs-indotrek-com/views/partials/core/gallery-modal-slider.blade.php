@php
  //vomit($content);
@endphp
@if ( !empty($content->gallery) && is_array($content->gallery) && count($content->gallery) > 2 )
<section class="section section--gallery-modal-slider"  id="gallery">
    <div class="section__inner">
        <div class="grid grid-gap-xxxxs grid-gap-sm@sm items-end">
            <div class="col-6@sm">
                <div class="max-width-500 to-animate" data-animate="up">
                    <span class="section__label">{{ $content->caption  }}</span>
                    <h1 class="text-xl">{{ $content->title  }}</h1>
                </div>
                <modal-gallery-slider
                    :items="{{ json_encode($content->gallery) }}"
                ></modal-gallery-slider>                    
                <div class="card card--square margin-top-md">
                    <figure class="card__img to-animate" data-animate="up" data-delay=".4">
                        <div class="crop crop--fit crop--3:2">
                            <img class="crop__content crop__content--center" src="{{ $content->gallery[0]['image']  }}" alt="{{ $content->gallery[0]['description'] }}">
                            <div class="card__frame">
                                <img src="@image('card-frame.svg')" alt="">
                            </div>
                        </div>
                    </figure>
                </div>
            </div>

            <div class="col-6@sm">

                <div class="grid grid-gap-xxxxs to-animate" data-animate="up" data-delay=".2">
                    <div class="col-12">
                        <div class="card card--square">
                            <figure class="card__img">
                                <div class="crop crop--fit crop--3:2">
                                    <img class="crop__content crop__content--center" src="{{ $content->gallery[1]['image']  }}" alt="{{ $content->gallery[1]['description'] }}">
                                    <div class="card__frame">
                                        <img src="@image('card-frame.svg')" alt="">
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card card--square card--half-frame">
                            <figure class="card__img">
                                <div class="crop crop--fit crop--3:2">
                                    <img class="crop__content crop__content--center-top" src="{{ $content->gallery[2]['image']  }}" alt="{{ $content->gallery[2]['description'] }}">
                                    <div class="card__frame">
                                        <img src="@image('card-frame.svg')" alt="">
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
@endif