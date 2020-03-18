@php
   //vomit($content);
@endphp

<hotels-filter-listing
    :filter-list="{{ json_encode($content->filterList) }}"
    :items-list="{{ json_encode($content->postList) }}"
    :init-show-items="9"
    :number-load-items="6"
/>