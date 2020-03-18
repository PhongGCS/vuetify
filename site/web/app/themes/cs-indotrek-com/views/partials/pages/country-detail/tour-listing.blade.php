<tours-filter-listing
        :filter-list="{{ json_encode([getFilterItem('activity')]) }}"
        :items-list="{{ json_encode($destination->getTours()) }}"
        :init-show-items="6"
        :number-load-items="3"
    >
   <!-- Add title + subtitle content  -->
   <template #subtitle="props"> {{ __('Tours', 'indotrek')}} </template>
   <template #title="props"> {{ __('Experience the real ', 'indotrek'). $destination->title }}  </template>
   <!-- end -->
</tours-filter-listing>