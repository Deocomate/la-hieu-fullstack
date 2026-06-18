@props([
    'src',
    'alt',
    'index',
    'wrapperClass' => 'w-full mb-[10px] break-inside-avoid overflow-hidden group relative shadow-sm',
    'imageClass' => 'w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105',
    'overlayClass' => 'absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none',
])

<button type="button" data-gallery-index="{{ $index }}"
    {{ $attributes->merge(['class' => 'gallery-trigger '.$wrapperClass]) }}>
    <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $imageClass }}" loading="lazy">
    <div class="{{ $overlayClass }}"></div>
</button>
