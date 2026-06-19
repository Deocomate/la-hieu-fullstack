@extends('components.layouts.main-client')

@section('content')
    <x-clients.hero.index-banner
        :title="$page->hero_title ?? 'VIDEOGRAPHY'"
        :bg-text="$page->hero_bg_text ?? 'VIDEOGRAPHY'"
    />

    <x-clients.article.list :articles="$articles" :card-layout="$cardLayout ?? 'zigzag'" />

    <x-clients.sections.follow />
@endsection
