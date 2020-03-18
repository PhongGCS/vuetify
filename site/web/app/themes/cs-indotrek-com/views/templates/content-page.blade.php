@extends('layouts/page')

@section('content')
    @if ($page->hero && $page->hero->enabled)
        {!! $page->hero->render() !!}
    @endif

    @foreach($content->content as $contentItem)
        {!! $contentItem->render( [
            'errors'=>$errors,
            'params'=>$params,
            'themeSettings' => (isset($themeSettings) ? $themeSettings : null),
            'currentFilter' => (isset($currentFilter) ? $currentFilter : null),
           ])
        !!}
    @endforeach

@endsection


@section('footerScripts')
@endsection