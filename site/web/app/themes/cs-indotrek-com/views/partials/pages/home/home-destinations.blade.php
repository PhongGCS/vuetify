@php
    //vomit($content);
@endphp


<section class="section section--popular-destination-slider to-animate" data-animate="up">
    <div class="section__inner">
        <div class="grid grid-gap-md">
            <div class="col-6@md">
                <div class="max-width-500">
                    <span class="section__label">{{ $content->caption  }}</span>
                    <h1 class="text-xl">{{ $content->title  }}</h1>
                    <span class="section__divider">
                        <img src="/img/section-divider.svg" alt="">
                    </span>
                </div>
            </div>
            <div class="col-6@md">
                <div class="text-component">
                    <p>{{ $content->description }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="margin-top-md">
        <base-slider :items="{{ json_encode($content->destinationList) }}" has-navigation infinite-scroll center-mode auto-play :settings="{breakpoints:{320:{itemsToShow:1.25}, 768:{itemsToShow: 2}, 1024:{itemsToShow:4}}}">
            <template v-slot:content="props">
                <!-- Card -->
                <destination-slide-card 
                :data="props.data" />
            </template>
            
            <template #navigation-prev>
                <svg width="68" height="68" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g filter="url(#filter0_d)">
                    <circle r="24" transform="matrix(-1 0 0 1 34 31)" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M31.4142 31L36.7071 36.2929C37.0976 36.6834 37.0976 37.3166 36.7071 37.7071C36.3166 38.0976 35.6834 38.0976 35.2929 37.7071L29.2929 31.7071C28.9024 31.3166 28.9024 30.6834 29.2929 30.2929L35.2929 24.2929C35.6834 23.9024 36.3166 23.9024 36.7071 24.2929C37.0976 24.6834 37.0976 25.3166 36.7071 25.7071L31.4142 31Z" fill="#383E41"/>
                    </g>
                    <defs>
                    <filter id="filter0_d" x="0" y="0" width="68" height="68" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                    <feOffset dy="3"/>
                    <feGaussianBlur stdDeviation="5"/>
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                    </filter>
                    </defs>
                </svg>                   
            </template>
            
            <template #navigation-next>
                <svg width="68" height="68" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g filter="url(#filter0_d)">
                    <circle cx="34" cy="31" r="24" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M36.5858 31L31.2929 36.2929C30.9024 36.6834 30.9024 37.3166 31.2929 37.7071C31.6834 38.0976 32.3166 38.0976 32.7071 37.7071L38.7071 31.7071C39.0976 31.3166 39.0976 30.6834 38.7071 30.2929L32.7071 24.2929C32.3166 23.9024 31.6834 23.9024 31.2929 24.2929C30.9024 24.6834 30.9024 25.3166 31.2929 25.7071L36.5858 31Z" fill="#383E41"/>
                    </g>
                    <defs>
                    <filter id="filter0_d" x="0" y="0" width="68" height="68" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                    <feOffset dy="3"/>
                    <feGaussianBlur stdDeviation="5"/>
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/>
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                    </filter>
                    </defs>
                </svg>                
            </template>
        </base-slider>
    </div>
</section>