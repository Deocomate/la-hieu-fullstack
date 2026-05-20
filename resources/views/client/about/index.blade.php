@extends('components.layouts.main-client')

@section('title', 'About me')

@section('content')
    @include('client.about.partials.about-section')
    @include('components.clients.follow-section')
@endsection
