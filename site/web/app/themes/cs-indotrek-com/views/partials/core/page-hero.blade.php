@if (isset($content->style))
    @include('partials.hero.page-hero-'.$content->style)
@endif


@if ($content->style == "default")

@elseif ($content->style == "tiles")

@elseif ($content->style == "video")
    <section class="hero hero--video hero--home">
        <div class="video-bg-wrapper">
            <div class="video-bg-inner">
                <div class="overlay"></div>
                {!! $content->video->getEmbedCode(0, 0, "video-bg", "video-banner") !!}
            </div>
            <script>
                var video = document.getElementById('video-banner');
                video.removeAttribute("controls");
            </script>
        </div>
        <div class="container">
            <h1 class="hero__heading">{{ $content->title }}</h1>
            <p class="hero__lead">{!! $content->subTitle !!}</p>

            @if ($content->primaryCTA->type != 'none')
                <a class="btn btn--default" href="{{ $content->primaryCTA->url }}">{{ $content->primaryCTA->title }}</a>
            @endif
            @if ($content->secondaryCTA->type != 'none')
                <a class="btn btn--default" href="{{ $content->secondaryCTA->url }}">{{ $content->secondaryCTA->title }}</a>

            @endif
        </div>
    </section>

@endif