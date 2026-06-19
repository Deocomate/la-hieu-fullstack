@php
    $pjDesktopBg = \App\Support\ClientImage::url(
        $page->content['photojournalism']['desktop_bg'] ?? null,
        'client/assets/static/home/photojournalism-background.png',
    );
    $pjMobileSlides = collect($page->content['photojournalism']['mobile_bg_slides'] ?? [])
        ->pluck('image')
        ->filter()
        ->values();
    $pjGalleryImages = collect($pjArticles ?? [])
        ->pluck('cover_image')
        ->filter()
        ->values();

    if ($pjGalleryImages->isEmpty()) {
        $pjGalleryImages = collect(range(1, 5))->map(fn ($i) => "client/assets/static/home/photojournalism-image-{$i}.png");
    }

    $galleryItems = [
        1 => ['wrapper' => '', 'img' => 'h-full aspect-[172/258]'],
        2 => ['wrapper' => '', 'img' => 'aspect-[172/258]'],
        3 => [
            'wrapper' => 'lg:col-span-1 sm:col-span-1 col-span-2 sm:col-auto',
            'img' => 'aspect-[172/258] sm:aspect-[172/258] aspect-video',
        ],
        4 => ['wrapper' => '', 'img' => 'aspect-[172/258]'],
        5 => ['wrapper' => '', 'img' => 'aspect-[172/258]'],
    ];
@endphp

<section
    class="relative w-full pt-[250px] pb-[90px] md:pt-16 md:pb-16 lg:pt-[188px] lg:pb-[92px] flex flex-col items-center overflow-hidden">
    <div class="absolute inset-0 z-0 hidden md:block">
        <img src="{{ $pjDesktopBg }}" alt="Photojournalism Background" class="w-full h-full object-cover">
        <div class="absolute inset-0"
            style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.20) 0%, rgba(0, 0, 0, 0.20) 100%), linear-gradient(0deg, black 0%, rgba(19, 19, 19, 0.82) 40%, rgba(34, 34, 34, 0.66) 64%, rgba(102, 102, 102, 0) 100%);">
        </div>
    </div>

    <div class="absolute inset-0 z-0 md:hidden bg-black overflow-hidden">
        <img src="{{ $pjDesktopBg }}"
            class="pj-bg-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-100"
            loading="lazy">

        @foreach ($pjMobileSlides as $slide)
            <img src="{{ \App\Support\ClientImage::url($slide) }}"
                class="pj-bg-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0"
                loading="lazy">
        @endforeach

        @foreach ($pjGalleryImages->take(5) as $image)
            <img src="{{ \App\Support\ClientImage::url($image) }}"
                class="pj-bg-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0"
                loading="lazy">
        @endforeach

        <div class="absolute inset-0 pointer-events-none z-10"
            style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0) 35%, #000000 65%, #000000 100%);">
        </div>
    </div>

    <div class="absolute top-[18px] left-[18px] z-20 md:hidden cursor-pointer animate-fade-in" id="pj-controller">
        <img src="{{ asset('client/assets/static/home/mobile-pause-button.svg') }}" id="pj-pause-icon" alt="Pause"
            class="w-[36px] h-[36px] object-contain">
        <img src="{{ asset('client/assets/static/home/mobile-play-button.svg') }}" id="pj-play-icon" alt="Play"
            class="w-[36px] h-[36px] object-contain hidden">
    </div>

    <div class="relative z-10 w-full px-[30px] md:px-4 flex flex-col items-center">
        <h2
            class="font-be-vietnam text-[24px] md:text-hero-sm font-extrabold tracking-[2.4px] md:tracking-[4.4px] uppercase text-white text-center typing-effect">
            {{ $page->content['photojournalism']['title'] ?? 'photojournalism' }}
        </h2>
        <p class="font-be-vietnam text-[14px] md:text-body-18-wide font-medium tracking-[0.14px] md:tracking-[0.9px] text-white text-center max-w-[767px] mt-[15px] md:mt-6 lg:mt-[45px] text-shadow-image"
            data-aos="fade-up" data-aos-delay="200">
            {{ $page->content['photojournalism']['description'] ?? 'Out in the field, there is no script. It is simply about stepping into different lives, listening quietly, and documenting their truths exactly as they unfold.' }}
        </p>
    </div>

    <div
        class="relative z-10 w-full max-w-[940px] ml-[50px] md:ml-0 mt-[113px] md:mt-12 lg:mt-[104px] flex flex-row md:grid overflow-x-auto md:overflow-visible snap-x snap-mandatory md:grid-cols-2 lg:grid-cols-5 gap-[15px] md:gap-4 lg:gap-[20px] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
        @foreach ($galleryItems as $i => $classes)
            @php
                $article = $pjArticles->values()->get($i - 1);
                $image = $article?->cover_image ?? $pjGalleryImages->get($i - 1, "client/assets/static/home/photojournalism-image-{$i}.png");
            @endphp
            <a href="{{ $article ? route('photojournalism.show', $article->slug) : route('photojournalism.index') }}"
                class="w-[240px] sm:w-[280px] md:w-full flex-shrink-0 snap-start overflow-hidden shadow-lg group cursor-pointer {{ $classes['wrapper'] }}"
                data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <img src="{{ \App\Support\ClientImage::url($image) }}"
                    alt="{{ $article?->title ?? 'Photojournalism ' . $i }}"
                    class="w-full h-full md:h-auto object-cover transition-transform duration-500 group-hover:scale-105 {{ $classes['img'] }}"
                    loading="lazy">
            </a>
        @endforeach
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const slides = document.querySelectorAll('.pj-bg-slide');
            const controller = document.getElementById('pj-controller');
            const pauseIcon = document.getElementById('pj-pause-icon');
            const playIcon = document.getElementById('pj-play-icon');

            if (slides.length === 0) return;

            let currentIndex = 0;
            let slideInterval = null;
            let isPlaying = true;
            const intervalTime = 4000;

            function nextSlide() {
                slides[currentIndex].classList.remove('opacity-100');
                slides[currentIndex].classList.add('opacity-0');
                currentIndex = (currentIndex + 1) % slides.length;
                slides[currentIndex].classList.remove('opacity-0');
                slides[currentIndex].classList.add('opacity-100');
            }

            function startSlideshow() {
                if (!slideInterval) {
                    slideInterval = setInterval(nextSlide, intervalTime);
                }
            }

            function stopSlideshow() {
                if (slideInterval) {
                    clearInterval(slideInterval);
                    slideInterval = null;
                }
            }

            if (controller && pauseIcon && playIcon) {
                controller.addEventListener('click', function() {
                    if (isPlaying) {
                        stopSlideshow();
                        pauseIcon.classList.add('hidden');
                        playIcon.classList.remove('hidden');
                    } else {
                        startSlideshow();
                        playIcon.classList.add('hidden');
                        pauseIcon.classList.remove('hidden');
                    }
                    isPlaying = !isPlaying;
                });
            }

            if (window.innerWidth < 768) {
                startSlideshow();
            }

            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    stopSlideshow();
                } else if (isPlaying && window.innerWidth < 768) {
                    startSlideshow();
                }
            });
        });
    </script>
@endpush
