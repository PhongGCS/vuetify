    <section class="section first-resize-gutter" data-theme="default">
        <div class="section__inner">
            <div class="grid grid-gap-md">
                <div class="col-6@sm col-8@md">
                    <div id="intro-content">
                      <nav class="s-tabs">
                          <ul class="s-tabs__list">
                              <li><a href="{{get_permalink(CONTACT_ID)}}">{{ get_the_title(CONTACT_ID) }}</a></li>
                              <li><a href="{{get_permalink(PRIVATE_TOUR_ID)}}" class="s-tabs__item--selected">{{ get_the_title(PRIVATE_TOUR_ID) }}</a></li>
                          </ul>
                      </nav>
                      
                      <div class="margin-top-md">
                          <h1 class="text-xl">{{ $content->title }}</h1>
                          <span class="section__divider">
                            <img class="lazy" data-src="@image('section-divider.svg')" alt="">
                          </span>
                          <div class="text-component margin-top-sm">
                              <p>{{ $content->description }}</p>
                          </div>
                          <p class="text-small color-shade margin-top-sm">{{ $content->instructionText }}</p>
                      </div>
                    </div>

                    <base-form
                        form-action="/api/private-form"
                        form-token="{{ wp_create_nonce("indotrek-token") }}"
                        :form-items="{{ json_encode($content->getPrivateTourForm()) }}"
                        label-style="floating"
                        label-position="top"
                    > 
                      <template #btn-submit="props">
                          <a href="" class="btn btn--primary" @click.prevent="props.submitForm">{{ __('Send', 'indotrek')}}</a>
                      </template>
                      <template #thank-you="props">
                          <h2>{{ $themeSettings->forms->successfultitle }}</h2>
                          <span class="section__divider">
                              <img class="lazy" data-src="@image('section-divider.svg')" alt="">
                          </span>
                          <div class="text-component margin-top-sm">
                              <p>{{ $themeSettings->forms->successfulDescription }}</p>
                          </div>
                          <a href="{{ get_home_url() }}" class="btn btn--primary margin-top-md">{{ __('Keep browsing', 'indotrek') }}</a>
                          <img class="margin-top-md lazy" data-src="@image('thank-you-bike.jpg')" alt="{{ $themeSettings->forms->successfultitle }}">
                      </template>

                    </base-form>
                </div>
                
                <div class="col-6@sm col-4@md">
                    <div class="card">
                        <div class="crop  crop--2:1">
                            <img class="crop__content crop__content--center" class="lazy" data-src="{{ $themeSettings->contactBox->image }}" alt="">
                        </div>
                        <div class="card__content has-no-padding" data-theme="light">
                            <dl class="details-list">
                              @if(!empty($themeSettings->contactBox->address))
                                <div class="details-list__item">
                                    <div class="details-list__dt">Address</div>
                                    <div class="details-list__dd">
                                        {{ $themeSettings->contactBox->address }}
                                    </div>
                                </div>
                              @endif
                              @if(!empty($themeSettings->contactBox->phone))
                                <div class="details-list__item">
                                    <div class="details-list__dt">Tel</div>
                                    <div class="details-list__dd">
                                        <a href='tel:{{ $themeSettings->contactBox->phone }}'>{{ $themeSettings->contactBox->phone }}</a>
                                    </div>
                                </div>
                              @endif
                              @if(!empty($themeSettings->contactBox->fax))
                                <div class="details-list__item">
                                    <div class="details-list__dt">Fax</div>
                                    <div class="details-list__dd">
                                        <a href='tel:{{ $themeSettings->contactBox->fax }}'>{{ $themeSettings->contactBox->fax }}</a> 
                                    </div>
                                </div>
                              @endif
                              @if(!empty($themeSettings->contactBox->email))
                                <div class="details-list__item">
                                    <div class="details-list__dt">Email</div>
                                    <div class="details-list__dd">
                                        <a href='mailto:{{ $themeSettings->contactBox->email }}'>{{ $themeSettings->contactBox->email }}</a>
                                    </div>
                                </div>
                              @endif
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>