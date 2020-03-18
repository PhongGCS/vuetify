@php
@endphp
<section class="section section--overview-hotel">
    <div class="section__inner">
        <div class="flex">
            <div class="col-8@md">
                <h2 class="text-lg text-capitalize margin-bottom-xs">Overview</h2>
                <div class="text-component">
                    <p> {!! $text !!}</p>
                </div>
                @if ( !empty($noteLiting) && is_array($noteLiting) && count($noteLiting) )
                <ol class="adding-list">
                    @foreach ($noteLiting as $item)
                        <li class="adding-list__item">
                            <header class="adding-list__item-header">
                                <div class="adding-list__sum-title">
                                    {{ $item['caption'] }}
                                </div>
                                <div class="adding-list__item-title">
                                    {{ $item['title'] }}
                                </div>
                            </header>
                            <div class="adding-list__item-content">
                                <div class="text-component">
                                    <p> {!! $item['text'] !!}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ol>
                @endif
            </div>
            <div class="col-4@md"></div>
        </div>
    </div>
</section>