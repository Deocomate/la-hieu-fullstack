@extends('components.layouts.main-client')

@section('title', 'Home')

@section('content')
    @include('client.home.partials.hero-section')
    @include('client.home.partials.event-photography-section')
    @include('client.home.partials.photojournalism-section')
    @include('client.home.partials.videography-section')
    @include('client.home.partials.faces-and-places-section')
    @include('client.home.partials.partners-section')
    @include('components.clients.follow-section')
@endsection
