@php
	//vomit($themeSettings);
  $footer1 = cs_get_menu_array("Footer Column 1");
  $navFooter1 = array();
  if(!empty ($footer1) && is_array($footer1) && count($footer1) ){
      foreach($footer1 as $item){
          $navFooter1[] = [
              "title" => $item['title'],
              "url" => $item['url'],
              "active" => $item['PostID'] == get_the_ID(),
          ];
      }
  }

  $footer2 = cs_get_menu_array("Footer Column 2");
  $navFooter2 = array();
  if(!empty ($footer2) && is_array($footer2) && count($footer2) ){
      foreach($footer2 as $item){
          $navFooter2[] = [
              "title" => $item['title'],
              "url" => $item['url'],
              "active" => $item['PostID'] == get_the_ID(),
          ];
      }
  }

  $footer3 = cs_get_menu_array("Footer Column 3");
  $navFooter3 = array();
  if(!empty ($footer3) && is_array($footer3) && count($footer3) ){
      foreach($footer3 as $item){
          $navFooter3[] = [
              "title" => $item['title'],
              "url" => $item['url'],
              "active" => $item['PostID'] == get_the_ID(),
          ];
      }
  }
@endphp


<footer class="section main-footer">
	<div class="section__inner padding-y-xl">
		<div class="main-footer__content">
			<nav class="main-footer__nav">
				<ul class="main-footer__nav-list">
					<li class="main-footer__nav-item">
						<h4>{{ __('Destinations', 'indotrek') }}</h4>

						<div class="grid grid-gap-sm">
            @if ( !empty($navFooter1) && is_array($navFooter1) && count($navFooter1) )
              @foreach ($navFooter1 as $item)
								<div class="col-6"><a href="{{$item['url']}}">{{$item['title']}}</a></div>
							@endforeach
            @endif
						</div>
					</li>
					<li class="main-footer__nav-item">
						<h4>{{ __('Activities', 'indotrek') }}</h4>

						<div class="grid grid-gap-sm">
            @if ( !empty($navFooter2) && is_array($navFooter2) && count($navFooter2) )
              @foreach ($navFooter2 as $item)
								<div class="col-6"><a href="{{$item['url']}}">{{$item['title']}}</a></div>
							@endforeach
            @endif
						</div>
					</li>
					<li class="main-footer__nav-item">
						<h4>{{ __('Indotrek', 'indotrek') }}</h4>

						<div class="grid grid-gap-sm">
            @if ( !empty($navFooter3) && is_array($navFooter3) && count($navFooter3) )
              @foreach ($navFooter3 as $item)
								<div class="col-6"><a href="{{$item['url']}}">{{$item['title']}}</a></div>
							@endforeach
            @endif
						</div>
						<div class="socials margin-bottom-sm margin-top-xs">
							<ul class="socials__btns flex flex-gap-sm flex-wrap">
              @if(!empty($themeSettings->general->facebook))
                <li>
									<a href="{{ $themeSettings->general->facebook }}" target="blank_">
										<i class="fab fa-facebook icon"></i>
									</a>
								</li>
							@endif
              @if(!empty($themeSettings->general->instagram))
                <li>
									<a href="{{ $themeSettings->general->instagram }}" target="blank_">
										<i class="fab fa-instagram icon"></i>
									</a>
								</li>
							@endif
              @if(!empty($themeSettings->general->linkedin))
                <li>
									<a href="{{ $themeSettings->general->linkedin }}" target="blank_">
										<i class="fab fa-linkedin icon"></i>
									</a>
								</li>
							@endif
              @if(!empty($themeSettings->general->twitter))
                <li>
									<a href="{{ $themeSettings->general->twitter }}" target="blank_">
										<i class="fab fa-twitter icon"></i>
									</a>
								</li>
              @endif
              @if(!empty($themeSettings->general->pinterest))
								<li>
									<a href="{{ $themeSettings->general->pinterest }}" target="blank_">
										<i class="fab fa-pinterest icon"></i>
									</a>
								</li>
              @endif
							</ul>
						</div>
						<dl class="details-list-v2 ">
							<div class="details-list-v2__item">
								<dd class="details-list-v2__dd">
									<a href="">
										{!! $themeSettings->footer->firstLine !!}
									</a>
								</dd>
							</div>
							<div class="details-list-v2__item">
								<dd class="details-list-v2__dd">
									{!! $themeSettings->footer->secondLine !!}
								</dd>
							</div>
							<div class="details-list-v2__item">
								<dd class="details-list-v2__dd">
									{!! $themeSettings->footer->thirdLine !!}
								</dd>
							</div>
						</dl>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="main-footer__colophon">
		<div class="main-footer__colophon-nav">
			<span>{{ date("Y") }} © INDOTREK - All rights reserved</span>
		</div>
	</div>
</footer>