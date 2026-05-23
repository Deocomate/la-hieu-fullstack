@extends('components.layouts.main-client')

@section('title', 'Event Photo Detail')

@section('content')
    @include('components.clients.shared.hero-banner', [
        'title' => 'P4G Vietnam Summit',
        'subtitle' => '16th June 2019',
        'paddingTop' => 'pt-[35px] lg:pt-[80px]',
        'paddingBottom' => 'pb-[30px] lg:pb-[80px]',
        'headingClass' => 'text-[24px] md:text-hero-md font-extrabold md:font-bold tracking-[1.2px] md:tracking-normal',
        'subtitleClass' => 'text-[14px] md:text-body-16-norm font-normal md:font-light',
        'bgText' => 'EVENT PHOTOS',
    ])
    @include('components.clients.shared.detail-gallery-grid')
    @include('components.clients.follow-section')
@endsection
