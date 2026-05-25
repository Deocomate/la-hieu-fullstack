@extends('components.layouts.main-client')

@section('title', 'Faces & Places')

@section('content')
    @include('components.clients.shared.hero-banner', [
        'title' => $page->hero_title ?? 'FACES AND PLACES',
        'paddingTop' => 'pt-[33px] lg:pt-[80px]',
        'paddingBottom' => 'pb-[20px] lg:pb-[50px]',
        'bgText' => $page->hero_bg_text ?? 'FACES & PLACES',
    ])

    @include('client.faces-and-places.partials.fap-gallery-contain-section')

    @include('components.clients.follow-section')
@endsection
