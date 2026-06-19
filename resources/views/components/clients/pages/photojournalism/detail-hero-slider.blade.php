@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .photojournalism-detail-swiper .swiper-slide {
            width: 1096px !important;
            height: 685px;
            transition: opacity 0.5s ease;
        }

        .photojournalism-detail-swiper .swiper-slide:not(.swiper-slide-active) {
            opacity: 0.5;
        }

        .photojournalism-detail-swiper .swiper-slide-active {
            opacity: 1;
        }

        @media (max-width: 1280px) {
            .photojournalism-detail-swiper .swiper-slide {
                width: 85vw !important;
                height: 60vw;
                max-height: 685px;
            }
        }

        @media (max-width: 768px) {
            .photojournalism-detail-swiper .swiper-slide {
                width: 90vw !important;
                height: 65vw;
            }
        }

        @media (max-width: 480px) {
            .photojournalism-detail-swiper .swiper-slide {
                width: 92vw !important;
                height: 250px;
            }
        }
    </style>
@endpush

@php
    $sliderImages = $article->media
        ->pluck('file_url')
        ->filter()
        ->map(fn ($path) => \App\Support\ClientImage::url($path))
        ->values();

    if ($sliderImages->isEmpty()) {
        $sliderImages = collect([
            asset('assets/static/photojournalism/detail-slider-swiper-1.png'),
            asset('assets/static/photojournalism/detail-slider-swiper-2.png'),
        ]);
    }
@endphp

<section class="w-full bg-white md:pb-[37px] overflow-hidden" data-aos="fade-up">
    <div class="swiper photojournalism-detail-swiper w-full">
        <div class="swiper-wrapper">
            @foreach ($sliderImages as $index => $image)
                <div class="swiper-slide overflow-hidden shadow-sm">
                    <img src="{{ $image }}" alt="{{ $article->title }} Slide {{ $index + 1 }}"
                        class="w-full h-full max-h-[685px] object-cover">
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Swiper('.photojournalism-detail-swiper', {
                slidesPerView: 'auto',
                spaceBetween: 25,
                centeredSlides: true,
                initialSlide: 0,
                loop: false,
                grabCursor: true,
                speed: 600,
                keyboard: {
                    enabled: true,
                },
            });
        });
    </script>
@endpush
