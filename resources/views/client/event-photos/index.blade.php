@extends('components.layouts.main-client')

@section('title', 'Event Photos')

@section('content')
    @include('components.clients.shared.hero-banner', [
        'title' => $page->hero_title ?? 'Event Photos',
        'subtitle' => $page->hero_subtitle ?? 'Unposed emotions. The true pulse of the event',
        'description' => $page->hero_description ?? 'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event',
        'paddingTop' => 'pt-[40px] lg:pt-[80px]',
        'paddingBottom' => 'pb-[30px] lg:pb-[80px]',
        'bgText' => $page->hero_bg_text ?? 'EVENT PHOTOS',
    ])
    @include('client.event-photos.partials.gallery-section')
    @include('components.clients.follow-section')
@endsection
