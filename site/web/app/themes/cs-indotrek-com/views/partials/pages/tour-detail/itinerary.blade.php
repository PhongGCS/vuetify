@php
  //vomit($content);
@endphp  
<div class="padding-top-md" id="itinerary">
    <h3 class="text-lg text-capitalize margin-bottom-xs">{{ __('Itinerary', 'indotrek') }}</h3>
    @if( is_object($content->cta) && $content->cta->type != 'none')
      <a href="{{ $content->cta->url }}" class="btn btn--outline" download>
          <svg class="icon icon--xs margin-right-xxs" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M9.8 0H4.2V7H0L7 14L14 7H9.8V0Z" fill="#F8981C"/>
          </svg>
          {{ $content->cta->title }}
      </a>
    @endif

    <ol class="adding-list">
        @if ( !empty($content->itineraryItems) && is_array($content->itineraryItems) && count($content->itineraryItems) )
          @foreach ($content->itineraryItems as $item)
            <li class="adding-list__item">
                <header class="adding-list__item-header">
                    <div class="adding-list__sum-title">
                        {{ $item->day }}
                    </div>
                    <div class="adding-list__item-title">
                          {{ $item->title }}
                    </div>
                </header>
                <div class="adding-list__item-content">
                    <div class="text-component">
                        <p>  {!! $item->text !!}</p>
                    </div>
                </div>
            </li>
          @endforeach
        @endif
    </ol>
</div>