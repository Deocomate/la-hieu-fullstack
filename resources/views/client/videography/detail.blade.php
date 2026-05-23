@extends('components.layouts.main-client')

@section('title', 'Videography  detail')

@section('content')
    @include('client.videography.partials.detail-hero-slider-section')
    @include('components.clients.shared.hero-banner', [
        'title' => 'Morden trendy & design app',
        'subtitle' => 'August 8, 2020',
        'paddingTop' => 'pt-[33px] lg:pt-[80px]',
        'paddingBottom' => 'pb-[20px] lg:pb-[60px]',
        'headingClass' => 'text-[24px] md:text-hero-md font-extrabold tracking-[1.2px] md:tracking-normal',
        'subtitleClass' => 'text-body-16-norm font-light md:mt-6 lg:mt-[15px]',
        'bgText' => 'VIDEOGRAPHY',
    ])
    @include('components.clients.shared.detail-content-blocks')
    @include('components.clients.follow-section')
@endsection
