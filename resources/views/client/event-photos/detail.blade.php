@extends('components.layouts.main-client')

@section('title', $album->title)

@section('content')
    @include('components.clients.shared.hero-banner', [
        'title' => $album->title,
        'subtitle' => $album->event_date?->format('jS F Y') ?? '',
        'paddingTop' => 'pt-[35px] lg:pt-[80px]',
        'paddingBottom' => 'pb-[30px] lg:pb-[80px]',
        'headingClass' => 'text-[24px] md:text-hero-md font-extrabold md:font-bold tracking-[1.2px] md:tracking-normal',
        'subtitleClass' => 'text-[14px] md:text-body-16-norm font-normal md:font-light',
        'bgText' => $album->hero_bg_text ?? 'EVENT PHOTOS',
    ])
    @include('components.clients.shared.detail-gallery-grid', [
        'lightboxImages' => \App\Support\GalleryImage::fromMediaCollection($album->media, $album->title),
        'galleryId' => 'event-' . $album->slug,
        'altPrefix' => $album->title,
    ])
    @include('components.clients.follow-section')
@endsection
