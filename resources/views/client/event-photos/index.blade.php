@extends('components.layouts.main-client')

@section('content')
    <x-clients.hero.index-banner
        :title="$page->hero_title ?? 'Event Photos'"
        :subtitle="$page->hero_subtitle ?? 'Unposed emotions. The true pulse of the event'"
        :description="$page->hero_description ?? 'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event'"
        :bg-text="$page->hero_bg_text ?? 'EVENT PHOTOS'"
    />
    @include('components.clients.pages.event-photos.gallery')
    <x-clients.sections.follow />
@endsection
