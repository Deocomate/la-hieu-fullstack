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

        /* Responsive cho tablet & mobile */
        @media (max-width: 1024px) {
            .videography-swiper .swiper-slide {
                width: 65% !important;
                height: auto;
                aspect-ratio: 16/9;
            }
        }

        @media (max-width: 640px) {
            .videography-swiper .swiper-slide {
                width: 85% !important;
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

<section class="w-full bg-black py-16 lg:pt-[56px] lg:pb-[100px] flex flex-col items-center">

    <!-- Section Title -->
    <h2
        class="font-be-vietnam font-extrabold text-3xl lg:text-heading uppercase tracking-heading text-white text-center relative z-20 typing-effect">
        Videography
    </h2>

    <!-- Swiper Container - Đã thiết lập max-w-1145px và cắt bỏ tràn -->
    <div class="w-full max-w-[1145px] mt-8 lg:mt-[84px] mx-auto px-4 xl:px-0" data-aos="fade-up" data-aos-delay="200">

        <!-- Bỏ class overflow-visible để slider tuân thủ giới hạn 1145px -->
        <div class="swiper videography-swiper w-full rounded-lg">
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

                        <div class="watch-now-btn absolute bottom-4 lg:bottom-[38px] left-1/2 z-40">
                            <button
                                class="w-[180px] lg:w-[231px] h-[36px] lg:h-[40px] bg-[#FFE0A4] flex items-center justify-center gap-3 hover:bg-[#ffcf70] transition-colors cursor-pointer">
                                <span
                                    class="font-be-vietnam font-extrabold text-base lg:text-[20px] uppercase tracking-[2px] text-black">
                                    Watch Now
                                </span>
                                <img src="{{ asset('client/assets/static/home/videography-button.svg') }}"
                                    alt="Play" class="w-[10px] lg:w-[13px] h-[14px] lg:h-[18px] object-contain">
                            </button>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>

    <!-- Section Description -->
    <p
        class="font-be-vietnam font-light text-base lg:text-desc tracking-desc text-white text-center max-w-[750px] mt-12 lg:mt-[65px] px-4" data-aos="fade-up" data-aos-delay="300">
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
                // Chuyển sang hiệu ứng Creative để tuỳ biến toạ độ chính xác 100%
                effect: 'creative',
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 'auto',
                loop: true,
                initialSlide: 2,

                // Toán học cho việc Lộ 100px:
                // Slide 702px. Nếu ta dời (translate) slide phụ sang ngang 160px và thu nhỏ (scale) nó đi 0.85 lần
                // Nó sẽ thụt vào gầm slide chính, và phần viền thò ra sẽ rơi vào đúng khoàng 100-110px.
                creativeEffect: {
                    limitProgress: 2, // Tính toán logic cho tối đa 2 slide hai bên (tổng cộng 5 slide hiển thị)
                    prev: {
                        translate: ['-160px', 0, -100], // Dời trái 160px, đẩy ra đằng sau (-100)
                        scale: 0.85, // Thu nhỏ bằng đúng tỷ lệ ảnh 600/702 trong Figma
                    },
                    next: {
                        translate: ['160px', 0, -100], // Dời phải 160px, đẩy ra đằng sau (-100)
                        scale: 0.85,
                    },
                },

                // Responsive Breakpoints: Phóng nhỏ khoảng cách đẩy đi ở trên màn hình nhỏ
                breakpoints: {
                    320: {
                        creativeEffect: {
                            limitProgress: 2,
                            prev: {
                                translate: ['-60%', 0, -100],
                                scale: 0.85
                            },
                            next: {
                                translate: ['60%', 0, -100],
                                scale: 0.85
                            },
                        }
                    },
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
                    1024: {
                        creativeEffect: {
                            limitProgress: 2,
                            // Desktop: Chốt cứng tham số pixel
                            prev: {
                                translate: ['-160px', 0, -100],
                                scale: 0.85
                            },
                            next: {
                                translate: ['160px', 0, -100],
                                scale: 0.85
                            },
                        }
                    }
                }
            });
        });
    </script>
@endpush
