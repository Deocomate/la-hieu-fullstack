@extends('components.layouts.main-client')

@section('content')
    <x-clients.hero.index-banner
        :title="$page->hero_title ?? 'FACES AND PLACES'"
        :bg-text="$page->hero_bg_text ?? 'FACES & PLACES'"
    />

    @include('components.clients.pages.faces-and-places.gallery-contain')

    <x-clients.sections.follow />
@endsection
