@extends('components.layouts.main-client')

@section('title', 'Photojournalism')

@section('content')
    @include('components.clients.shared.hero-banner', [
        'title' => $page->hero_title ?? 'PHOTOJOURNALISM',
        'subtitle' => $page->hero_subtitle ?? 'Unposed emotions. The true pulse of the event',
        'bgText' => $page->hero_bg_text ?? 'PHOTOJOURNALISM',
    ])

    @include('components.clients.shared.article-list', ['cardLayout' => $cardLayout ?? 'zigzag'])

    @include('components.clients.follow-section')
@endsection
