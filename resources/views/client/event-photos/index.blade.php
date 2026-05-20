@extends('components.layouts.main-client')

@section('title', 'Event Photos')

@section('content')
    @include('client.event-photos.partials.hero-section')
    @include('client.event-photos.partials.gallery-section')
    @include('components.clients.follow-section')
@endsection
