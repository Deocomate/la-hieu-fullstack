@extends('components.layouts.main-client')

@section('content')
    @include('components.clients.pages.about.main')
    <x-clients.sections.follow />
@endsection
