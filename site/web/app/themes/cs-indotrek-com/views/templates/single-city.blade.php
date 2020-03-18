@extends('layouts/page')

@section('content')
  @include("partials.pages.city-detail.hero", ["content" => $destination->heroCity])
  @include("partials.pages.city-detail.overview", ["content" => $destination->cityOverview])
  @include("partials.pages.city-detail.tour-listing", [$destination])
  @include("partials.core.gallery-modal-slider", ["content" => $destination->cityGallery])
  @include("partials.pages.city-detail.city-related", [$destination])
@endsection
@section('footerScripts')
@endsection