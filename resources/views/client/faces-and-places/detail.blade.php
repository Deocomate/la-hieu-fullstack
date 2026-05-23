@extends('components.layouts.main-client')

@section('title', 'Faces And Places Detail')

@section('content')
    @include('components.clients.shared.hero-banner', [
        'title' => 'Faces & Places',
        'subtitle' => 'August 8, 2020',
        'paddingTop' => 'pt-[33px] lg:pt-[80px]',
        'paddingBottom' => 'pb-[20px] lg:pb-[60px]',
        'headingClass' => 'text-[24px] md:text-hero-md font-extrabold tracking-[1.2px] md:tracking-normal',
        'subtitleClass' => 'text-body-16-norm font-light md:mt-6 lg:mt-[15px]',
        'bgText' => 'FACES & PLACES',
    ])
    @include('components.clients.shared.detail-gallery-grid')
@endsection
