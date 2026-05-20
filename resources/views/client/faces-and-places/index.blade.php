@extends('components.layouts.main-client')

@section('title', 'Faces & Places')

@section('content')
    @include('client.faces-and-places.partials.hero-section')

    @include('client.faces-and-places.partials.fap-gallery-contain-section')

    @include('components.clients.follow-section')
@endsection
