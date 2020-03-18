@if (isset($content->heroObjects) && is_array($content->heroObjects))
    <section class="hero hero--carousel hero--home">
        <div class="carousel slide" id="heroCarousel" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($content->heroObjects as $hero)
                    <li class="{{ $loop->first ? "active" : "" }}" data-target="#heroCarousel" data-slide-to="{{ $loop->index }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
            @foreach ($content->heroObjects as $hero)
                    <div class="carousel-item {{ $loop->first ? "active" : "" }}">
                        <div class="hero hero--carousel-item-{{ $loop->index }}">
                            @if (isset($hero->image))
                                <style>
                                    .hero--carousel-item-{{ $loop->index }} {
                                        background-image: url("{!! $hero->image->src('hero-mobile') !!}");
                                    }
                                    @media (min-width: 768px) {
                                        .hero--carousel-item-{{ $loop->index }} {
                                            background-image: url("{!! $hero->image->src('hero') !!}");
                                        }
                                    }
                                </style>
                            @endif
                            <div class="container">
                                <h1 class="hero__heading">{{ $hero->title }}</h1>
                                <p class="hero__lead">{!! $hero->subTitle !!}</p>

                                @if ($hero->primaryCTA->type != 'none')
                                    <a class="btn btn--default" href="{{ $hero->primaryCTA->url }}">{{ $hero->primaryCTA->title }}</a>
                                @endif
                                @if ($hero->secondaryCTA->type != 'none')
                                    <a class="btn btn--default" href="{{ $hero->secondaryCTA->url }}">{{ $hero->secondaryCTA->title }}</a>

                                @endif
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>
    </section>
@endif