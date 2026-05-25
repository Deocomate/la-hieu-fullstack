@extends('components.layouts.main-client')

@section('title', $article->title)

@section('content')
    @include('client.photojournalism.partials.detail-hero-slider-section')
    @include('components.clients.shared.hero-banner', [
        'title' => $article->title,
        'subtitle' => $article->published_at?->format('F j, Y') ?? '',
        'paddingTop' => 'pt-[45px] lg:pt-[80px]',
        'paddingBottom' => 'pb-[20px] lg:pb-[60px]',
        'headingClass' => 'text-[24px] md:text-hero-md font-extrabold tracking-[1.2px] md:tracking-normal',
        'subtitleClass' => 'text-body-16-norm font-light md:mt-6 lg:mt-[15px]',
        'bgText' => 'PHOTOJOURNALISM',
    ])
    @include('components.clients.shared.detail-content-blocks', [
        'contentBlocks' => $article->content_blocks ?? [],
    ])
    @include('components.clients.follow-section')
@endsection
