@extends('components.layouts.main-client')

@section('content')
    <x-clients.hero.detail-banner
        :title="$album->title"
        :subtitle="$album->event_date?->format('jS F Y') ?? ''"
        :bg-text="$album->hero_bg_text ?? 'EVENT PHOTOS'"
    />
    <x-clients.gallery.detail-grid
        :lightbox-images="\App\Support\GalleryImage::fromMediaCollection($album->media, $album->title)"
        :gallery-id="'event-' . $album->slug"
        :alt-prefix="$album->title"
    />
    <x-clients.sections.follow />
@endsection
