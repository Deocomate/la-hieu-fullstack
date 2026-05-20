@extends('components.layouts.main-client')

@section('title', 'Photojournalism detail')

@section('content')
    @include('client.photojournalism.partials.detail-hero-slider-section')
    @include('client.photojournalism.partials.detail-heading-section')
    @include('client.photojournalism.partials.detail-content-section')
    @include('components.clients.follow-section')
@endsection
