@extends('components.layouts.main-client')

@section('title', 'Videography')

@section('content')
    @include('components.clients.shared.hero-banner', [
        'title' => $page->hero_title ?? 'VIDEOGRAPHY',
        'bgText' => $page->hero_bg_text ?? 'VIDEOGRAPHY',
    ])

    @include('components.clients.shared.article-list')

    @include('components.clients.follow-section')
@endsection
