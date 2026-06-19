@php
    $images = collect($images ?? [])
        ->filter()
        ->values();
    $fallbackImages = collect(range(1, 9))
        ->map(fn ($i) => asset("client/assets/static/faces-and-places/faces-and-places-{$i}.png"));

    if ($images->isEmpty()) {
        $images = $fallbackImages;
    }

    $displayImages = $images->pad(9, $images->first())->take(9)->values();
    $lightboxImages = $lightboxImages ?? \App\Support\GalleryImage::fromPaths($images, $title ?? 'Gallery Image');
    $interactiveCount = count($lightboxImages);
    $galleryId = $galleryId ?? 'fap-gallery';
@endphp
<div class="w-full flex flex-col items-center lg:pb-[60px]">
    <div class="w-full max-w-[725px] flex flex-col items-center text-center mb-8 lg:mb-[50px]" data-aos="fade-up">
        <h2
            class="font-be-vietnam font-extrabold text-[24px] md:text-[28px] lg:text-[36px] text-black uppercase tracking-[1.2px] md:tracking-[2.4px] leading-tight typing-effect">
            {{ $title }}
        </h2>

        <a href="{{ $viewAlbumUrl ?? '#' }}"
            class="font-be-vietnam font-light text-[12px] text-black underline mt-2 hover:text-gray-500 transition-colors leading-[22px]">
            View album
        </a>

        <p class="font-be-vietnam font-light text-[14px] lg:text-[16px] leading-[23px] text-black mt-6">
            {{ $description }}
        </p>
    </div>

    <div data-gallery="{{ $galleryId }}" data-gallery-images='@json($lightboxImages)'
        class="w-full max-w-[1320px] grid grid-cols-2 lg:grid-cols-4 gap-[10px]">
        <div class="flex flex-col gap-[10px]" data-aos="fade-up" data-aos-delay="100">
            <x-clients.gallery.fap-gallery-image-slot :src="$displayImages[0]" :index="0" aspect="322/510"
                :alt="$lightboxImages[0]['alt'] ?? 'Gallery Image 1'" :is-interactive="0 < $interactiveCount" />
            <x-clients.gallery.fap-gallery-image-slot :src="$displayImages[1]" :index="1" aspect="322/451"
                :alt="$lightboxImages[1]['alt'] ?? 'Gallery Image 2'" :is-interactive="1 < $interactiveCount" />
        </div>

        <div class="flex flex-col gap-[10px]" data-aos="fade-up" data-aos-delay="200">
            <x-clients.gallery.fap-gallery-image-slot :src="$displayImages[2]" :index="2" aspect="322/218"
                :alt="$lightboxImages[2]['alt'] ?? 'Gallery Image 3'" :is-interactive="2 < $interactiveCount" />
            <x-clients.gallery.fap-gallery-image-slot :src="$displayImages[3]" :index="3" aspect="322/504"
                :alt="$lightboxImages[3]['alt'] ?? 'Gallery Image 4'" :is-interactive="3 < $interactiveCount" />
            <x-clients.gallery.fap-gallery-image-slot :src="$displayImages[4]" :index="4" aspect="322/218"
                :alt="$lightboxImages[4]['alt'] ?? 'Gallery Image 5'" :is-interactive="4 < $interactiveCount" />
        </div>

        <div class="flex flex-col gap-[10px]" data-aos="fade-up" data-aos-delay="300">
            <x-clients.gallery.fap-gallery-image-slot :src="$displayImages[5]" :index="5" aspect="322/451"
                :alt="$lightboxImages[5]['alt'] ?? 'Gallery Image 6'" :is-interactive="5 < $interactiveCount" />
            <x-clients.gallery.fap-gallery-image-slot :src="$displayImages[6]" :index="6" aspect="322/452"
                :alt="$lightboxImages[6]['alt'] ?? 'Gallery Image 7'" :is-interactive="6 < $interactiveCount" />
        </div>

        <div class="flex flex-col gap-[10px]" data-aos="fade-up" data-aos-delay="400">
            <x-clients.gallery.fap-gallery-image-slot :src="$displayImages[7]" :index="7" aspect="322/598"
                :alt="$lightboxImages[7]['alt'] ?? 'Gallery Image 8'" :is-interactive="7 < $interactiveCount" />
            <x-clients.gallery.fap-gallery-image-slot :src="$displayImages[8]" :index="8" aspect="322/221"
                :alt="$lightboxImages[8]['alt'] ?? 'Gallery Image 9'" :is-interactive="8 < $interactiveCount" />
        </div>
    </div>
</div>
