@extends('components.layouts.main-client')

@section('title', 'Videography  detail')

@section('content')
    @include('client.videography.partials.detail-hero-slider-section')
    @include('client.videography.partials.detail-heading-section')
    @include('client.videography.partials.detail-content-section')
    @include('components.clients.follow-section')
@endsection
