@props([
    'images' => null,
    'lightboxImages' => null,
    'galleryId' => 'gallery',
    'altPrefix' => 'Gallery Image',
])

@php
    $defaultImages = [
        asset('assets/static/event-photo/gallery-grid-1.png'),
        asset('assets/static/event-photo/gallery-grid-2.png'),
        asset('assets/static/event-photo/gallery-grid-3.png'),
        asset('assets/static/event-photo/gallery-grid-4.png'),
        asset('assets/static/event-photo/gallery-grid-5.png'),
        asset('assets/static/event-photo/gallery-grid-6.png'),
        asset('assets/static/event-photo/gallery-grid-7.png'),
        asset('assets/static/event-photo/gallery-grid-8.png'),
    ];

    $lightboxImages = $lightboxImages ?? \App\Support\GalleryImage::fromPaths($images ?? $defaultImages, $altPrefix);

    if ($lightboxImages === []) {
        $lightboxImages = \App\Support\GalleryImage::fromPaths($defaultImages, $altPrefix);
    }
@endphp

<section class="w-full bg-white px-[30px] md:px-[25px] pb-[50px] md:py-[50px]">
    <div data-gallery="{{ $galleryId }}" data-gallery-images='@json($lightboxImages)'>
        <div class="w-full columns-2 md:columns-3 lg:grid lg:grid-cols-12 gap-[10px] lg:gap-[15px]" data-aos="fade-up">
            @foreach ($lightboxImages as $index => $image)
                @php
                    $mod = $index % 8;
                    $isWide = in_array($mod, [0, 2, 5, 7], true);
                    $spanClass = $isWide ? 'lg:col-span-4' : 'lg:col-span-2';
                    $wrapperClass = "w-full break-inside-avoid mb-[10px] lg:mb-0 {$spanClass} lg:h-[340px] overflow-hidden group relative shadow-sm";
                    $imageClass = 'w-full h-auto lg:h-full object-cover transition-transform duration-700 group-hover:scale-105';
                @endphp
                <x-clients.gallery.grid-trigger
                    :src="$image['src']"
                    :alt="$image['alt']"
                    :index="$index"
                    :wrapperClass="$wrapperClass"
                    :imageClass="$imageClass"
                />
            @endforeach
        </div>
    </div>
</section>
