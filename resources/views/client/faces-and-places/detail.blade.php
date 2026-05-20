@extends('components.layouts.main-client')

@section('title', 'Faces And Places Detail')

@section('content')
    @include('client.faces-and-places.partials.detail-hero-section')
    @include('client.faces-and-places.partials.detail-gallery-grid-section')
@endsection
