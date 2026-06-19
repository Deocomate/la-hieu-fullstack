@push('styles')
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #gallery-container {
            transition: opacity 0.3s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }
    </style>
@endpush

@php
    $albumPayload = $albums
        ->values()
        ->map(function ($album) {
            $images = $album->media
                ->pluck('file_url')
                ->filter()
                ->map(fn ($path) => \App\Support\ClientImage::url($path))
                ->values();

            if ($images->isEmpty() && $album->cover_image) {
                $images = collect([\App\Support\ClientImage::url($album->cover_image)]);
            }

            return [
                'key' => $album->slug,
                'title' => $album->title,
                'url' => route('event-photos.show', $album->slug),
                'images' => $images,
                'lightboxImages' => \App\Support\GalleryImage::fromMediaCollection($album->media, $album->title),
            ];
        });

    $activeAlbum = $albumPayload->first();
    $activeLightboxImages = $activeAlbum['lightboxImages'] ?? [];
@endphp

<section class="w-full bg-white pb-16 lg:pb-[100px] flex flex-col items-center">
    <div class="md:hidden w-full flex flex-col items-center mb-[30px] relative">
        <div class="w-full flex items-center justify-between px-[43px] relative h-[26px]">
            <button id="mobile-album-prev"
                class="cursor-pointer hover:opacity-70 transition-opacity flex items-center justify-center">
                <img src="{{ asset('assets/static/event-photo/prev.svg') }}" alt="Previous" class="w-auto h-[18px]">
            </button>

            <h2 id="mobile-album-title"
                class="font-be-vietnam font-bold text-[18px] text-black text-center mx-auto tracking-[0.5px]">
                {{ $activeAlbum['title'] ?? '' }}
            </h2>

            <button id="mobile-album-next"
                class="cursor-pointer hover:opacity-70 transition-opacity flex items-center justify-center">
                <img src="{{ asset('assets/static/event-photo/next.svg') }}" alt="Next"
                    class="w-auto h-[18px]">
            </button>
        </div>

        <a href="{{ $activeAlbum['url'] ?? '#' }}" id="mobile-album-link"
            class="font-be-vietnam font-light text-[12px] leading-[22px] text-black underline md:mt-2 hover:text-gray-500 transition-colors">
            View album
        </a>
    </div>

    <div class="w-full max-w-[1145px] mx-auto flex flex-col md:flex-row md:items-start lg:gap-[172px]">
        <aside class="hidden md:block w-full md:w-max flex-shrink-0 mb-8 md:mb-0 md:sticky md:top-[120px] z-20"
            data-aos="fade-right">
            <ul class="flex flex-row lg:flex-col items-start gap-6 lg:gap-0 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0 px-4 lg:px-0 hide-scrollbar"
                id="album-nav">
                @foreach ($albumPayload as $index => $album)
                    <li class="album-nav-item whitespace-nowrap lg:whitespace-normal @if ($index === 0) relative @else lg:mt-[22px] @endif"
                        data-album="{{ $album['key'] }}">
                        <h3
                            class="album-title font-be-vietnam font-bold text-[16px] leading-[22px] cursor-pointer hover:opacity-70 transition-opacity {{ $index === 0 ? 'text-black' : 'text-gray-400' }}">
                            {{ $album['title'] }}
                        </h3>

                        <a href="{{ $album['url'] }}"
                            class="album-link font-be-vietnam font-light text-[12px] leading-[22px] text-black underline lg:-mt-[2px] hover:text-gray-500 transition-colors {{ $index === 0 ? 'block' : 'hidden' }}">
                            View album
                        </a>

                        <div class="album-line absolute top-[11px] left-[105%] ml-[15px] {{ $index === 0 ? 'hidden lg:block' : 'hidden' }}">
                            <img src="{{ asset('assets/static/event-photo/gallery-mid-line.svg') }}" alt="Line"
                                class="w-auto h-auto min-w-[120px] opacity-70">
                        </div>
                    </li>
                @endforeach
            </ul>
        </aside>

        <div id="gallery-container" data-gallery="event-photos-active"
            data-gallery-images='@json($activeLightboxImages)'
            class="flex-1 w-full columns-2 md:columns-2 lg:columns-3 gap-[10px] pl-[30px] pr-[27px] md:pl-0 md:pr-0">
            @foreach ($activeLightboxImages as $index => $image)
                <button type="button" data-gallery-index="{{ $index }}"
                    class="gallery-trigger w-full mb-[10px] break-inside-avoid overflow-hidden bg-gray-100 group relative shadow-[0_2px_8px_rgba(0,0,0,0.05)] animate-fade-in-up"
                    style="animation-delay: {{ $index * 0.1 }}s">
                    <img src="{{ $image['src'] }}" alt="{{ $image['alt'] }}"
                        class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                        loading="lazy">
                    <div
                        class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                    </div>
                </button>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const albums = @json($albumPayload);
            const albumKeys = albums.map(album => album.key);
            let currentAlbumIndex = 0;

            const navItems = document.querySelectorAll('.album-nav-item');
            const galleryContainer = document.getElementById('gallery-container');
            const mobileTitle = document.getElementById('mobile-album-title');
            const mobileLink = document.getElementById('mobile-album-link');

            function escapeHtml(value) {
                return String(value ?? '')
                    .replace(/&/g, '&amp;')
                    .replace(/"/g, '&quot;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');
            }

            function renderGallery(album) {
                galleryContainer.dataset.galleryImages = JSON.stringify(album.lightboxImages || []);
                galleryContainer.style.opacity = '0';

                setTimeout(() => {
                    const items = album.lightboxImages || [];

                    galleryContainer.innerHTML = items.map((image, index) => `
                        <button type="button" data-gallery-index="${index}" class="gallery-trigger w-full mb-[10px] break-inside-avoid overflow-hidden bg-gray-100 group relative shadow-[0_2px_8px_rgba(0,0,0,0.05)] animate-fade-in-up" style="animation-delay: ${index * 0.1}s">
                            <img src="${escapeHtml(image.src)}" alt="${escapeHtml(image.alt || `Gallery Image ${index + 1}`)}" class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none"></div>
                        </button>
                    `).join('');

                    galleryContainer.style.opacity = '1';
                }, 300);
            }

            function setActiveAlbum(albumKey) {
                currentAlbumIndex = albumKeys.indexOf(albumKey);
                if (currentAlbumIndex === -1) currentAlbumIndex = 0;

                const activeAlbum = albums[currentAlbumIndex];

                navItems.forEach(nav => {
                    const isActive = nav.getAttribute('data-album') === activeAlbum.key;
                    const title = nav.querySelector('.album-title');
                    const link = nav.querySelector('.album-link');
                    const line = nav.querySelector('.album-line');

                    nav.classList.toggle('relative', isActive);
                    title.classList.toggle('text-black', isActive);
                    title.classList.toggle('text-gray-400', !isActive);
                    link.classList.toggle('hidden', !isActive);
                    link.classList.toggle('block', isActive);
                    line.classList.toggle('hidden', !isActive);
                    line.classList.toggle('lg:block', isActive);
                });

                if (mobileTitle) mobileTitle.textContent = activeAlbum.title;
                if (mobileLink) mobileLink.href = activeAlbum.url;
                renderGallery(activeAlbum);
            }

            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    if (e.target.tagName.toLowerCase() === 'a') return;
                    setActiveAlbum(this.getAttribute('data-album'));
                });
            });

            document.getElementById('mobile-album-prev')?.addEventListener('click', function() {
                currentAlbumIndex = (currentAlbumIndex - 1 + albumKeys.length) % albumKeys.length;
                setActiveAlbum(albumKeys[currentAlbumIndex]);
            });

            document.getElementById('mobile-album-next')?.addEventListener('click', function() {
                currentAlbumIndex = (currentAlbumIndex + 1) % albumKeys.length;
                setActiveAlbum(albumKeys[currentAlbumIndex]);
            });
        });
    </script>
@endpush
