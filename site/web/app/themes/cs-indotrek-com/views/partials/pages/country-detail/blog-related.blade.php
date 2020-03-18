@php
   $blogRelated = $destination->getRelatedBlog();
@endphp
@if ( !empty($blogRelated) && is_array($blogRelated) && count($blogRelated) )
<section class="section section--blog-listing to-animate" data-animate="up">
    <div class="section__inner">
        <div class="grid grid-gap-md items-end">
            <div class="col-6@md">
                <div class="max-width-500">
                    <span class="section__label">{{ __('Blog', 'indotrek')  }}</span>
                    <h1 class="text-xl">{{ __('Experience the real ', 'indotrek') . $destination->title. "."  }}</h1>
                    <span class="section__divider">
                        <img src="@image('section-divider.svg')" alt="">
                    </span>
                </div>
            </div>
        </div>
        <div class="text-component margin-y-md">
            <hr>
        </div>
        <div class="grid grid-gap-md">
            @foreach ($blogRelated as $item)
                <div class="col-6@xs">
                    <blog-card :data="{{ json_encode($item) }}" />
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif