@extends('components.layouts.main-client')

@section('content')
    <x-clients.hero.detail-banner
        :title="$album->title"
        :subtitle="$album->created_at?->format('F j, Y') ?? ''"
        :bg-text="$album->hero_bg_text ?? 'FACES & PLACES'"
    />
    <x-clients.gallery.detail-grid
        :lightbox-images="\App\Support\GalleryImage::fromMediaCollection($album->media, $album->title)"
        :gallery-id="'fap-' . $album->slug"
        :alt-prefix="$album->title"
    />
    <x-clients.sections.follow />
@endsection
