@extends('components.layouts.main-client')

@section('title', 'Videography')

@section('content')
    @include('components.clients.shared.hero-banner', [
        'title' => 'VIDEOGRAPHY',
        'bgText' => 'VIDEOGRAPHY',
    ])

    @include('components.clients.shared.article-list')

    @include('components.clients.follow-section')
@endsection
