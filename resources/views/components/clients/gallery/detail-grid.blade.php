@props([
    'images' => null,
    'lightboxImages' => null,
    'galleryId' => 'gallery',
    'altPrefix' => 'Gallery Image',
])

@php
    $defaultImages = [
        asset('client/assets/static/event-photo/gallery-grid-1.png'),
        asset('client/assets/static/event-photo/gallery-grid-2.png'),
        asset('client/assets/static/event-photo/gallery-grid-3.png'),
        asset('client/assets/static/event-photo/gallery-grid-4.png'),
        asset('client/assets/static/event-photo/gallery-grid-5.png'),
        asset('client/assets/static/event-photo/gallery-grid-6.png'),
        asset('client/assets/static/event-photo/gallery-grid-7.png'),
        asset('client/assets/static/event-photo/gallery-grid-8.png'),
    ];

    $lightboxImages = $lightboxImages ?? \App\Support\GalleryImage::fromPaths($images ?? $defaultImages, $altPrefix);

    if ($lightboxImages === []) {
        $lightboxImages = \App\Support\GalleryImage::fromPaths($defaultImages, $altPrefix);
    }
@endphp

<section class="w-full bg-white px-[30px] md:px-[25px] pb-[50px] md:py-[50px]">
    <div data-gallery="{{ $galleryId }}" data-gallery-images='@json($lightboxImages)'>
        <div class="w-full columns-2 lg:columns-3 gap-[10px] lg:gap-[15px]" data-aos="fade-up">
            @foreach ($lightboxImages as $index => $image)
                <x-clients.gallery.grid-trigger :src="$image['src']" :alt="$image['alt']" :index="$index" />
            @endforeach
        </div>
    </div>
</section>
