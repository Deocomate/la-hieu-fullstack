@extends('components.layouts.main-client')

@section('content')
    <x-clients.hero.index-banner
        :title="$page->hero_title ?? 'PHOTOJOURNALISM'"
        :subtitle="$page->hero_subtitle ?? 'Unposed emotions. The true pulse of the event'"
        :bg-text="$page->hero_bg_text ?? 'PHOTOJOURNALISM'"
    />

    <x-clients.article.list :articles="$articles" :card-layout="$cardLayout ?? 'zigzag'" />

    <x-clients.sections.follow />
@endsection
