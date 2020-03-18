<section class="section hero hero--full-screen padding-y-xxl to-animate" style="background-image: url({{ $content->background }});" data-theme="transparent">
    <div class="section__inner max-width-adaptive-sm">
      <div class="hero__content text-center position-relative bg-inherit" data-theme="dark">
            <div class="text-component margin-bottom-md to-animate" data-animate="up">
               <h1>{{ $content->title }}</h1>
            </div>

            @if ($content->svgMap)
               <img class="hero__country-image to-animate" data-delay=".2" src="{{ $content->svgMap }}" alt="{{ $content->title }}">
            @endif
      </div>
    </div>
    <a href="#overview" class="js-smooth-scroll hero__scroll-down" data-duration="400">
        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle r="23.5" transform="matrix(-4.37114e-08 1 1 4.37114e-08 24 24)" stroke="white"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M23.4923 25.8503L18.1432 20.6476C17.9963 20.5043 17.7999 20.4255 17.5904 20.4255C17.3808 20.4255 17.1845 20.5043 17.0373 20.6476L16.5688 21.1035C16.4214 21.2465 16.3403 21.4377 16.3403 21.6415C16.3403 21.8452 16.4214 22.0362 16.5688 22.1793L22.9373 28.3739C23.085 28.5176 23.2822 28.5963 23.4919 28.5957C23.7026 28.5963 23.8996 28.5177 24.0473 28.3739L30.4096 22.1851C30.557 22.0419 30.6382 21.851 30.6382 21.6471C30.6382 21.4434 30.557 21.2524 30.4097 21.1091L29.9412 20.6534C29.6363 20.3568 29.1399 20.3568 28.8351 20.6534L23.4923 25.8503Z" fill="white"/>
        </svg>    
    </a>
    <div class="section-divider" style="background-image: url(@image('hero-skewline.png'));"></div>
</section>