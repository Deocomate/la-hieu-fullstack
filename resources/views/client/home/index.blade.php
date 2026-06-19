@extends('components.layouts.main-client')

@section('content')
    @include('components.clients.pages.home.hero')
    @include('components.clients.pages.home.event-photography')
    @include('components.clients.pages.home.photojournalism')
    @include('components.clients.pages.home.videography')
    @include('components.clients.pages.home.faces-and-places')
    @include('components.clients.pages.home.partners')
    <x-clients.sections.follow />
@endsection
