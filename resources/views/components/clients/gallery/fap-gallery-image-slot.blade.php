@props([
    'src',
    'index',
    'aspect',
    'alt' => 'Gallery Image',
    'isInteractive' => true,
])

@php
    $wrapperClass = 'w-full overflow-hidden group relative shadow-sm bg-gray-100';
    $imageClass = 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-105';
    $overlayClass = 'absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none';
@endphp

@if ($isInteractive)
    <button type="button" data-gallery-index="{{ $index }}"
        class="gallery-trigger {{ $wrapperClass }}" style="aspect-ratio: {{ $aspect }};">
        <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $imageClass }}" loading="lazy">
        <div class="{{ $overlayClass }}"></div>
    </button>
@else
    <div class="{{ $wrapperClass }}" style="aspect-ratio: {{ $aspect }};">
        <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $imageClass }}" loading="lazy">
        <div class="{{ $overlayClass }}"></div>
    </div>
@endif
