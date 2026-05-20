@extends('components.layouts.main-client')

@section('title', 'Photojournalism')

@section('content')
    @include('client.photojournalism.partials.hero-section')

    @include('client.photojournalism.partials.photojournalism-list-card-contain-section')

    @include('components.clients.follow-section')
@endsection
