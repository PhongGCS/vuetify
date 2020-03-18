<section class="section section--overview to-animate" data-animate="up" id="overview">
    <div class="section__inner">
        <div class="grid grid-gap-md">
            <div class="col-6@md">
                <h2 class="text-lg">{!! $content->title !!}</h3>
            </div>
            <div class="col-6@md">
                <div class="text-component">
                    <p>{!! $content->description !!}</p>
                </div>
            </div>
        </div>
         @if ( !empty( $content->repeaterInfo) && is_array( $content->repeaterInfo) && count( $content->repeaterInfo) )
         <div class="flex flex-wrap justify-between@sm flex-gap-md margin-top-lg">
            @foreach ( $content->repeaterInfo as $item)
               <div class="flex items-baseline">
                  <div class="flex-shrink-0">
                     {{-- <svg style="margin-bottom: -8px;" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M22.5 8.49987L17.2689 13.8244L18.2441 21.3277L11.991 17.3092L5.13474 20.6992L6.83315 13.5149L2 8.49986C2 8.49986 8.30676 11.4049 10.4034 9.4524C12.5 7.49987 12 2 12 2L15.716 8.02889L22.5 8.49987Z" fill="#F8981C"/>
                           <path d="M12 1.12978L15.0783 7.36718L15.1947 7.6029L15.4548 7.6407L22.3382 8.64092L17.3573 13.4961L17.1691 13.6795L17.2135 13.9386L18.3894 20.7942L12.2327 17.5574L12 17.4351L11.7673 17.5574L5.61064 20.7942L6.78647 13.9386L6.8309 13.6795L6.64267 13.4961L1.6618 8.64092L8.54519 7.6407L8.80532 7.6029L8.92166 7.36718L12 1.12978Z" stroke="#383E41"/>
                     </svg> --}}
                     <img src="{{$item->icon}}" style="margin-bottom: -8px;" alt="">                           
                  </div>
                  <div class="margin-left-xxxs">
                     <p class="text-capitalize">{{ $item->caption }}</p>
                     <p class="font-weight-bold text-capitalize margin-top-xxxs">{{ $item->title }}</p>
                  </div>
               </div>
            @endforeach
         </div>
         @endif
    </div>
</section>