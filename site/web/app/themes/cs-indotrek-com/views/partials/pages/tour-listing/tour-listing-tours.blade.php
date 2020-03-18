@php
  $filter = $content->currentFilter;
  if(is_tax('activity')) {
    $filter = $currentFilter;
  }
@endphp

    <tours-filter-listing
        has-navigation
        :filter-list="{{ json_encode($content->filterList) }}"
        :items-list="{{ json_encode($content->postList) }}"
        :init-filters="{{ json_encode($filter) }}"
        :init-show-items="9"
        :number-load-items="6"
    >
    </tours-filter-listing>