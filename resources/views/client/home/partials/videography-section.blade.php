@push('styles')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        /* Tùy chỉnh kích thước cố định của slide THEO ĐÚNG ẢNH MAIN (702x395) */
        .videography-swiper .swiper-slide {
            width: 702px !important;
            height: 395px;
            transition: all 0.3s ease;
        }

        /* Responsive cho tablet */
        @media (max-width: 1024px) {
            .videography-swiper .swiper-slide {
                width: 65% !important;
                height: auto;
                aspect-ratio: 16/9;
            }
        }

        /* Responsive chuẩn xác cho Mobile (<768px) theo Design */
        @media (max-width: 767px) {
            .videography-swiper .swiper-slide {
                width: 230px !important;
                height: 125px !important;
                aspect-ratio: auto;
            }
        }

        /* -------------------------------------
                   LOGIC MÀU OVERLAY ĐÚNG CHUẨN DESIGN
                ------------------------------------- */
        /* 1. Mặc định (Các slide phụ cấp 2 - xa nhất): Đen 60% */
        .video-slide-overlay {
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.60) 0%, rgba(0, 0, 0, 0.60) 100%);
            opacity: 1;
            transition: opacity 0.5s ease, background 0.5s ease;
        }

        /* 2. Slide phụ cấp 1 (Kề bên slide chính): Đen 40% */
        .swiper-slide-prev .video-slide-overlay,
        .swiper-slide-next .video-slide-overlay {
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.40) 0%, rgba(0, 0, 0, 0.40) 100%);
        }

        /* 3. Slide chính (Active giữa): Sáng hoàn toàn */
        .swiper-slide-active .video-slide-overlay {
            opacity: 0;
            pointer-events: none;
        }

        /* Hiệu ứng Nút Watch Now: Chỉ hiện ở slide Active */
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

<!-- Section Container: Cập nhật pb-[55px] cho mobile -->
<section
    class="w-full bg-black md:pt-16 pb-[55px] md:py-16 lg:pt-[56px] lg:pb-[100px] flex flex-col items-center overflow-hidden">

    <!-- Section Title -->
    <h2
        class="font-be-vietnam text-[24px] md:text-hero-sm font-extrabold tracking-[2.4px] md:tracking-[4.4px] uppercase text-white text-center relative z-20 typing-effect">
        Videography
    </h2>

    <!-- Swiper Container - Khoảng cách Title -> Slider: mt-[40px] cho mobile -->
    <!-- Xoá px-4 ở mobile (thành px-0) để Swiper tự động xử lý tràn viền chuẩn xác 30px -->
    <div class="w-full max-w-[1145px] mt-[40px] md:mt-8 lg:mt-[84px] mx-auto px-0 md:px-4 xl:px-0" data-aos="fade-up"
        data-aos-delay="200">

        <!-- Bỏ class overflow-visible để slider tuân thủ giới hạn 1145px -->
        <div class="swiper videography-swiper w-full md:rounded-lg">
            <div class="swiper-wrapper">

                @php
                    $videos = [
                        'videography-1.png',
                        'videography-2.png',
                        'videography-3.png',
                        'videography-4.png',
                        'videography-5.png',
                    ];
                @endphp

                @foreach ($videos as $index => $video)
                    <div class="swiper-slide relative overflow-hidden group shadow-2xl">
                        <img src="{{ asset('client/assets/static/home/' . $video) }}"
                            alt="Videography {{ $index + 1 }}" class="w-full h-full object-cover">

                        <div class="video-slide-overlay absolute inset-0 z-10 pointer-events-none"></div>

                        <!-- Button Watch Now: Mobile căn bottom-[12px] -->
                        <div class="watch-now-btn absolute bottom-[12px] md:bottom-4 lg:bottom-[38px] left-1/2 z-40">
                            <button
                                class="w-[115px] md:w-[180px] lg:w-[231px] h-[24px] md:h-[36px] lg:h-[40px] bg-[#FFE0A4] flex items-center justify-center gap-2 lg:gap-3 hover:bg-[#ffcf70] transition-colors cursor-pointer">
                                <span
                                    class="font-be-vietnam text-[10px] md:text-[14px] lg:text-h-card-20-wide font-extrabold uppercase text-black tracking-[1px] md:tracking-[2px]">
                                    Watch Now
                                </span>
                                <img src="{{ asset('client/assets/static/home/videography-button.svg') }}"
                                    alt="Play"
                                    class="w-[6px] md:w-[10px] lg:w-[13px] h-[8px] md:h-[14px] lg:h-[18px] object-contain">
                            </button>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>

    <!-- Section Description -->
    <!-- Slider -> Text: mt-[50px]. Padding 2 bên text: px-[30px] -->
    <p class="font-be-vietnam text-[14px] md:text-body-18-wide font-light tracking-[0.7px] md:tracking-[0.9px] text-white text-center max-w-[750px] mt-[50px] md:mt-12 lg:mt-[65px] px-[30px] md:px-4"
        data-aos="fade-up" data-aos-delay="300">
        Creating a moving video is about capturing moments that resonate deeply.<br class="hidden lg:inline" />
        It highlights the beauty of real life, showing how genuine connections<br class="hidden lg:inline" />
        and raw imperfections make a story truly perfect.
    </p>

</section>

@push('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiper = new Swiper('.videography-swiper', {
                effect: 'creative',
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 'auto',
                loop: true,
                initialSlide: 2,

                // Responsive Breakpoints: Logic dịch chuyển (translate) slider
                breakpoints: {
                    // Mobile: Logic thò ra chuẩn 35px theo Design (Slide 230px -> dịch ±35px = lộ 35px)
                    320: {
                        creativeEffect: {
                            limitProgress: 2,
                            prev: {
                                translate: ['-35px', 0, -100], // Dịch chính xác 35px sang bên trái
                                scale: 1 // Giữ nguyên scale 1 để chiều cao ảnh đúng 125px
                            },
                            next: {
                                translate: ['35px', 0, -100], // Dịch chính xác 35px sang bên phải
                                scale: 1
                            },
                        }
                    },
                    // Tablet: Giữ nguyên logic cũ của bạn
                    768: {
                        creativeEffect: {
                            limitProgress: 2,
                            prev: {
                                translate: ['-45%', 0, -100],
                                scale: 0.85
                            },
                            next: {
                                translate: ['45%', 0, -100],
                                scale: 0.85
                            },
                        }
                    },
                    // Desktop: Giữ nguyên logic cũ của bạn
                    1024: {
                        creativeEffect: {
                            limitProgress: 2,
                            prev: {
                                translate: ['-200px', 0, -100],
                                scale: 0.85
                            },
                            next: {
                                translate: ['200px', 0, -100],
                                scale: 0.85
                            },
                        }
                    }
                }
            });
        });
    </script>
@endpush
