@php
$menuItems = cs_get_menu_array("Main menu");
$navItemsList = array();
if(!empty ($menuItems) && is_array($menuItems) && count($menuItems) ){
    foreach($menuItems as $item){

        $subMenu = null;
        if (count($item['children']) > 0){
            foreach ($item['children'] as $item2) {
                $subMenu[] = [
                    "title" => $item2['title'],
                    "url" => $item2['url'] ,
                ];
            }
        }
        $navItemsList[] = [
            "title" => $item['title'],
            "url" => $item['url'] ,
            "active" => $item['PostID'] == get_the_ID(),
            "subItems" => $subMenu,
        ];
    }
}
$logo = [
    'url' => get_home_url(),
    'image' => [
    'black' => $themeSettings->header->white,
    'white' => $themeSettings->header->black,
    ]
];

@endphp
{{-- <cs-header
  ref="pageHeader"
  :nav-logo="{{ json_encode($logo) }}"
  :nav-items="{{ json_encode($navItemsList) }}"
>
</cs-header>  --}}
@php
    set_query_var( 'vw_nav_menu', 'primary' );
    $name = get_query_var( 'vw_nav_menu' );
    //vomit($name);
@endphp
{{-- <nav class="main-menu">

    @foreach ( RADL::get( 'state.menus' )[$name] as $item )

    <a href="{{ $item['url'] }}" target="{{ $item['target'] }}"
        title="{{ $item['title'] }}">{{ $item['content'] }}</a>

    @endforeach
</nav> --}}