@extends('components.layouts.main-client')

@section('title', $album->title)

@section('content')
    @include('components.clients.shared.hero-banner', [
        'title' => $album->title,
        'subtitle' => $album->created_at?->format('F j, Y') ?? '',
        'paddingTop' => 'pt-[33px] lg:pt-[80px]',
        'paddingBottom' => 'pb-[20px] lg:pb-[60px]',
        'headingClass' => 'text-[24px] md:text-hero-md font-extrabold tracking-[1.2px] md:tracking-normal',
        'subtitleClass' => 'text-body-16-norm font-light md:mt-6 lg:mt-[15px]',
        'bgText' => $album->hero_bg_text ?? 'FACES & PLACES',
    ])
    @include('components.clients.shared.detail-gallery-grid', [
        'images' => $album->media->pluck('file_url')->map(fn ($path) => \App\Support\ClientImage::url($path)),
    ])
    @include('components.clients.follow-section')
@endsection
