@extends('components.layouts.main-client')

@section('content')
    @include('components.clients.pages.videography.detail-hero-slider')
    <x-clients.hero.detail-banner
        :title="$article->title"
        :subtitle="$article->published_at?->format('F j, Y') ?? ''"
        bg-text="VIDEOGRAPHY"
    />
    <x-clients.article.detail-content :content-blocks="$article->content_blocks ?? []" />
    <x-clients.sections.follow />
@endsection
