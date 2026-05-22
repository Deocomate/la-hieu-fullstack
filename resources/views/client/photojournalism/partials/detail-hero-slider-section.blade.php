{{-- resources/views/client/photojournalism/partials/detail-hero-slider-section.blade.php --}}

@push('styles')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* Tùy chỉnh kích thước cố định của slide theo yêu cầu (1096x800) */
        .photojournalism-detail-swiper .swiper-slide {
            width: 1096px !important;
            height: 685px;
            transition: opacity 0.5s ease;
        }

        /* Làm mờ nhẹ các slide không active để tôn slide chính (Tùy chọn thẩm mỹ) */
        .photojournalism-detail-swiper .swiper-slide:not(.swiper-slide-active) {
            opacity: 0.5;
        }

        .photojournalism-detail-swiper .swiper-slide-active {
            opacity: 1;
        }

        /* Responsive cho Desktop nhỏ, Tablet & Mobile */
        @media (max-width: 1280px) {
            .photojournalism-detail-swiper .swiper-slide {
                width: 85vw !important;
                height: 60vw;
                /* Giữ tỷ lệ khung hình tương đối */
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

<!-- Padding bottom 37px theo chuẩn thiết kế. Thêm padding top để cách header -->
<section class="w-full bg-white md:pb-[37px] overflow-hidden" data-aos="fade-up">
    <!-- Swiper Container: Full Width -->
    <div class="swiper photojournalism-detail-swiper w-full">
        <div class="swiper-wrapper">
            @php
                // Có 2 ảnh gốc trong folder, nhân bản ra mảng 4 item để demo slider vuốt mượt mà
                $sliderImages = [
                    'detail-slider-swiper-1.png',
                    'detail-slider-swiper-2.png',
                    'detail-slider-swiper-1.png',
                    'detail-slider-swiper-2.png',
                ];
            @endphp

            @foreach ($sliderImages as $index => $image)
                <!-- Swiper Slide -->
                <div class="swiper-slide overflow-hidden shadow-sm">
                    <!-- Ảnh full width và height của thẻ bọc 1096x800, object-cover tránh méo ảnh -->
                    <img src="{{ asset('client/assets/static/photojournalism/' . $image) }}"
                        alt="Photojournalism Detail Slide {{ $index + 1 }}"
                        class="w-full h-full max-h-[685px] object-cover">
                </div>
            @endforeach
        </div>
    </div>
</section>
@push('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiper = new Swiper('.photojournalism-detail-swiper', {
                // Nhận độ rộng cấu hình trong CSS thay vì chia đều cột
                slidesPerView: 'auto',

                // Gap cố định 25px giữa các item
                spaceBetween: 25,

                // Main slide vẫn luôn ở giữa màn hình
                centeredSlides: true,

                // Bắt đầu ở slider đầu tiên (Index 0)
                initialSlide: 0,

                // ĐIỂM QUAN TRỌNG NHẤT LÀ Ở ĐÂY: 
                // Đổi thành false để Swiper không nhân bản slide cuối lên đặt vào bên trái slide đầu tiên nữa
                loop: false,

                grabCursor: true,
                speed: 600, // Tốc độ chuyển cảnh mượt mà

                keyboard: {
                    enabled: true,
                },
            });
        });
    </script>
@endpush
