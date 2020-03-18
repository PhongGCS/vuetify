@extends('layouts/page')

@section('content')
  @include("partials.pages.hotel-detail.hero", ["content" => $hotel->getHeroImage() ])
  @include("partials.pages.hotel-detail.overview", ["text" => $hotel->overview, "noteLiting" => $hotel->noteLiting ])

  @include("partials.core.gallery-modal-slider", ["content" => $hotel->photosGallery])
  


@endsection
@section('footerScripts')
@endsection