@php
  //vomit($mainPost->getTags());
@endphp

<section class="section hero hero--half-screen padding-y-xxl to-animate" style="background-image: url({{ $mainPost->getHeroImage() }});" data-theme="transparent">
    <div class="section__inner max-width-adaptive-sm">
        <div class="hero__content text-center bg-inherit" data-theme="dark">
            <div class="text-component to-animate" data-animate="up">
                <h1>{{ $mainPost->title }}</h1>
            </div>
        </div>
    </div>
    <div class="section-divider" style="background-image: url(@image('hero-skewline.png'));"></div>
</section>

<section class="section section--nav-article">
    <div class="container flex">
        <div class="max-width-xxxxs width-100% margin-bottom-md">
            <a href="{{ get_permalink(BLOG_ID) }}" class="link link--with-icon">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 7H3.8L9.4 1.4L8 0L0 8L8 16L9.4 14.6L3.8 9H16V7Z" fill="#F8981C"/>
                </svg>     
                <span>
                    {{__('back', 'indotrek')}}
                </span>               
            </a>
            <nav>
                <ul class="flex flex-wrap flex-gap-xs">
                  @if ( !empty($mainPost->getTags()) && is_array($mainPost->getTags()) && count($mainPost->getTags()) )
                    @foreach ($mainPost->getTags() as $item)
                      <span class="link tag-link">{{ $item->name }}</span>
                    @endforeach
                  @endif
                </ul>
            </nav>
        </div>
        <article class="article text-component max-width-xs width-100%">
            <span class="card__subtitle">{{ $mainPost->date }}</span>
            <h1 class="text-xl margin-top-xxxs">{{ $mainPost->title }}</h1>
            {!! apply_filters('the_content', get_post_field('post_content', get_the_ID())) !!}
        </article>
    </div>
</section>



<section class="section section--blog-listing to-animate" data-animate="up">
    <div class="section__inner">
        <div class="text-component margin-y-md">
            <hr>
        </div>
        <div class="max-width-500 margin-bottom-xxs">
            <span class="section__label">{{ __("related articles", "indotrek")  }}</span>
        </div>
        <div class="grid grid-gap-md">
            @if ( !empty($mainPost->getRelatedBlog()) && is_array($mainPost->getRelatedBlog()) && count($mainPost->getRelatedBlog()) )
              @foreach ($mainPost->getRelatedBlog() as $item)
                <div class="col-6@xs">
                    <blog-card :data="{{ json_encode($item) }}" />
                </div>
              @endforeach
            @endif
        </div>
    </div>
</section>