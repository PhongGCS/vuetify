@extends('layouts/page')

@section('content')
  @include("partials.pages.country-detail.hero", ["content" => $destination->heroCountry])
  @include("partials.pages.country-detail.overview", ["content" => $destination->countryOverview])
  @include("partials.pages.country-detail.city-listing", [$destination])
  @include("partials.pages.country-detail.tour-listing", [$destination])
  @include("partials.pages.country-detail.blog-related", [$destination])
  @include("partials.core.gallery-modal-slider", ["content" => $destination->countryGallery])
@endsection
@section('footerScripts')
@endsection