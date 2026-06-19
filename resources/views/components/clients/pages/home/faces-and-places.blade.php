@php
    $galleryImages = collect($facesAlbums ?? [])
        ->flatMap(fn ($album) => $album->media->pluck('file_url'))
        ->filter()
        ->values();

    if ($galleryImages->isEmpty()) {
        $galleryImages = collect($facesAlbums ?? [])
            ->pluck('cover_image')
            ->filter()
            ->values();
    }

    if ($galleryImages->isEmpty()) {
        $galleryImages = collect(range(1, 19))->map(fn ($i) => "client/assets/static/home/faces-and-places-{$i}.png");
    }

    $lightboxImages = \App\Support\GalleryImage::fromPaths($galleryImages, 'Faces and Places');
@endphp

<section
    class="w-full bg-white px-0 md:px-4 lg:px-[31px] pt-12 lg:pt-[80px] pb-12 lg:pb-[55px] flex flex-col items-center overflow-hidden md:overflow-visible">
    <h2
        class="font-be-vietnam text-[24px] md:text-hero-sm font-extrabold tracking-[2.4px] md:tracking-[4.4px] uppercase text-black text-center typing-effect px-[30px] md:px-0">
        {{ $page->content['faces']['title'] ?? 'faces & places' }}
    </h2>

    <div data-gallery="home-faces-and-places" data-gallery-images='@json($lightboxImages)'
        class="w-full mt-10 lg:mt-[80px] md:mx-auto flex flex-col md:block flex-wrap content-start h-[560px] md:h-auto overflow-x-auto overflow-y-hidden md:overflow-visible gap-x-[10px] md:gap-[12px] ml-[50px] md:ml-0 snap-x snap-mandatory md:snap-none md:columns-4 lg:columns-6 xl:columns-8 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] after:content-[''] after:w-[30px] md:after:hidden after:h-full after:shrink-0">

        @foreach ($lightboxImages as $index => $image)
            <x-clients.gallery.grid-trigger :src="$image['src']" :alt="$image['alt']" :index="$index"
                wrapperClass="w-[180px] md:w-full break-inside-avoid snap-start mb-[10px] md:mb-3 lg:mb-[12px] overflow-hidden shadow-sm group relative bg-gray-100 rounded-sm"
                imageClass="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-110"
                overlayClass="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none"
                data-aos="fade-up" :data-aos-delay="(($index + 1) % 4) * 100" />
        @endforeach
    </div>

    <p class="font-be-vietnam text-[14px] md:text-body-18-wide font-light tracking-[0.14px] md:tracking-[0.9px] text-black text-center max-w-[728px] mt-10 lg:mt-[61px] mx-auto px-[30px] md:px-0"
        data-aos="fade-up">
        {{ $page->content['faces']['description'] ?? 'This collection is a visual diary of the roads I have traveled and the people I have met. More than just coordinates or portraits, these images preserve the raw, real emotions of a specific fraction in time.' }}
    </p>
</section>
