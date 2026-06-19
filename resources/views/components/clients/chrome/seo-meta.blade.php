@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'url' => null,
    'type' => 'website',
])

@php
    $resolvedTitle = $title ?: config('app.name');
    $resolvedDescription = $description ?: '';
    $resolvedImage = $image ? \App\Support\ClientImage::url($image) : '';
    $resolvedUrl = $url ?: url()->current();
@endphp

<title>{{ $resolvedTitle }}</title>
<meta name="description" content="{{ $resolvedDescription }}">
<link rel="canonical" href="{{ $resolvedUrl }}">

<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $resolvedTitle }}">
<meta property="og:description" content="{{ $resolvedDescription }}">
<meta property="og:url" content="{{ $resolvedUrl }}">
@if ($resolvedImage)
<meta property="og:image" content="{{ $resolvedImage }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $resolvedTitle }}">
<meta name="twitter:description" content="{{ $resolvedDescription }}">
@if ($resolvedImage)
<meta name="twitter:image" content="{{ $resolvedImage }}">
@endif
