@extends('components.layouts.main-client')

@section('title', 'Event Photo Detail')

@section('content')
    @include('client.event-photos.partials.detail-hero-section')
    @include('client.event-photos.partials.detail-gallery-grid-section')
    @include('components.clients.follow-section')
@endsection
