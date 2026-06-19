@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .videography-swiper {
            overflow: visible !important;
        }

        .videography-swiper .swiper-slide {
            width: 702px !important;
            height: 395px;
            transition: all 0.3s ease;
        }

        @media (max-width: 1024px) {
            .videography-swiper .swiper-slide {
                width: 65% !important;
                height: auto;
                aspect-ratio: 16/9;
            }
        }

        @media (max-width: 767px) {
            .videography-swiper .swiper-slide {
                width: 230px !important;
                height: 127px !important;
                aspect-ratio: auto;
            }
        }

        .video-slide-overlay {
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.60) 0%, rgba(0, 0, 0, 0.60) 100%);
            opacity: 1;
            transition: opacity 0.5s ease, background 0.5s ease;
        }

        .swiper-slide-prev .video-slide-overlay,
        .swiper-slide-next .video-slide-overlay {
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0.40) 100%);
        }

        .swiper-slide-active .video-slide-overlay {
            opacity: 0;
            pointer-events: none;
        }

        .watch-now-btn {
            opacity: 0;
            visibility: hidden;
            transform: translate(-50%, 20px);
            transition: all 0.5s ease;
        }

        .swiper-slide-active .watch-now-btn {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, 0);
        }
    </style>
@endpush

@php
    $slides = collect($videoArticles ?? []);

    if ($slides->isEmpty()) {
        $slides = collect(range(1, 5))->map(fn ($i) => (object) [
            'title' => "Videography {$i}",
            'slug' => null,
            'cover_image' => "assets/static/home/videography-{$i}.png",
        ]);
    }
@endphp

<section
    class="w-full bg-black md:pt-16 pb-[50px] md:py-16 lg:pt-[56px] lg:pb-[100px] flex flex-col items-center overflow-hidden">
    <h2
        class="font-be-vietnam text-[24px] md:text-hero-sm font-extrabold tracking-[2.4px] md:tracking-[4.4px] uppercase text-white text-center relative z-20 typing-effect">
        {{ $page->content['videography']['title'] ?? 'Videography' }}
    </h2>

    <div class="w-full max-w-[1145px] mt-[40px] md:mt-8 lg:mt-[84px] mx-auto px-0 md:px-4 xl:px-0" data-aos="fade-up"
        data-aos-delay="200">
        <div class="swiper videography-swiper w-full md:rounded-lg">
            <div class="swiper-wrapper">
                @foreach ($slides as $index => $video)
                    @php
                        $href = $video->slug ? route('videography.show', $video->slug) : route('videography.index');
                    @endphp
                    <div class="swiper-slide relative overflow-hidden group shadow-2xl">
                        <a href="{{ $href }}" class="block w-full h-full">
                            <img src="{{ \App\Support\ClientImage::url($video->cover_image, 'assets/static/home/videography-1.png') }}"
                                alt="{{ $video->title }}" class="w-full h-full object-cover">

                            <div class="video-slide-overlay absolute inset-0 z-10 pointer-events-none"></div>

                            <div class="watch-now-btn absolute bottom-[12px] md:bottom-4 lg:bottom-[38px] left-1/2 z-40">
                                <span
                                    class="w-[115px] md:w-[180px] lg:w-[231px] h-[24px] md:h-[36px] lg:h-[40px] bg-[#FFE0A4] flex items-center justify-center gap-2 lg:gap-3 hover:bg-[#ffcf70] transition-colors cursor-pointer">
                                    <span
                                        class="font-be-vietnam text-[10px] md:text-[14px] lg:text-h-card-20-wide font-extrabold uppercase text-black tracking-[1px] md:tracking-[2px]">
                                        Watch Now
                                    </span>
                                    <img src="{{ asset('assets/static/home/videography-button.svg') }}"
                                        alt="Play"
                                        class="w-[6px] md:w-[10px] lg:w-[13px] h-[8px] md:h-[14px] lg:h-[18px] object-contain">
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <p class="font-be-vietnam text-[14px] md:text-body-18-wide font-light tracking-[0.7px] md:tracking-[0.9px] text-white text-center max-w-[750px] mt-[50px] md:mt-12 lg:mt-[65px] px-[30px] md:px-4"
        data-aos="fade-up" data-aos-delay="300">
        {{ $page->content['videography']['description'] ?? 'Creating a moving video is about capturing moments that resonate deeply. It highlights the beauty of real life, showing how genuine connections and raw imperfections make a story truly perfect.' }}
    </p>
</section>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Swiper('.videography-swiper', {
                effect: 'creative',
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 'auto',
                loop: true,
                initialSlide: 2,
                breakpoints: {
                    320: {
                        creativeEffect: {
                            limitProgress: 3,
                            prev: { translate: ['-70px', 0, -100], scale: 0.85 },
                            next: { translate: ['70px', 0, -100], scale: 0.85 },
                        }
                    },
                    768: {
                        creativeEffect: {
                            limitProgress: 3,
                            prev: { translate: ['-50%', 0, -100], scale: 0.85 },
                            next: { translate: ['50%', 0, -100], scale: 0.85 },
                        }
                    },
                    1024: {
                        creativeEffect: {
                            limitProgress: 3,
                            prev: { translate: ['-320px', 0, -100], scale: 0.85 },
                            next: { translate: ['320px', 0, -100], scale: 0.85 },
                        }
                    }
                }
            });
        });
    </script>
@endpush
