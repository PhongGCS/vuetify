@php
   //vomit($content);
@endphp
<section class="section hero hero--half-screen padding-y-xxl to-animate" style="background-image: url({{ $content}});" data-theme="transparent">
    <div class="section__inner max-width-adaptive-sm">
        <div class="hero__content text-center bg-inherit" data-theme="dark">
            <div class="text-component to-animate" data-animate="up">
                <h1>{{ get_the_title() }}</h1>
            </div>
        </div>
    </div>
    <div class="section-divider" style="background-image: url(@image('hero-skewline.png'));"></div>
</section>