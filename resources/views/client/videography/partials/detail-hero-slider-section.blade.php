{{-- resources/views/client/videography/partials/detail-hero-slider-section.blade.php --}}
@push('styles')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        /* Tùy chỉnh kích thước khung slider theo chuẩn thiết kế (1420px x 800px) */
        .videography-detail-swiper {
            width: 100%;
            max-width: 1420px;
            height: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .videography-detail-swiper .swiper-slide {
            width: 100%;
            height: 100%;
        }

        /* Tự động responsive tỉ lệ khung hình trên thiết bị di động & tablet */
        @media (max-width: 1420px) {
            .videography-detail-swiper {
                height: 56.34vw;
                /* Giữ nguyên tỉ lệ 1420:800 */
                max-height: 800px;
            }
        }

        @media (max-width: 768px) {
            .videography-detail-swiper {
                height: 60vw;
            }
        }

        @media (max-width: 480px) {
            .videography-detail-swiper {
                height: 250px;
            }
        }
    </style>
@endpush

<section class="w-full bg-white overflow-hidden" data-aos="fade-up">
    <!-- Swiper Container: Giới hạn tối đa 1420px -->
    <div class="swiper videography-detail-swiper w-full">
        <div class="swiper-wrapper">
            @php
                // Danh sách hình ảnh thực tế từ thư mục static/videography
                $sliderImages = ['hero-slider-1.png', 'hero-slider-2.png', 'hero-slider-3.png'];
            @endphp
            @foreach ($sliderImages as $index => $image)
                <!-- Swiper Slide -->
                <div class="swiper-slide overflow-hidden shadow-sm">
                    <img src="{{ asset('client/assets/static/videography/' . $image) }}"
                        alt="Videography Detail Slide {{ $index + 1 }}" class="w-full h-full object-cover">
                </div>
            @endforeach
        </div>
    </div>

    <!-- Thanh điều hướng custom bên dưới Slider -->
    <div class="flex items-center justify-center" data-aos="fade-up" data-aos-delay="200">
        <!-- Nút Previous -->
        <button
            class="videography-prev-btn cursor-pointer focus:outline-none hover:opacity-70 transition-opacity flex items-center justify-center">
            <img src="{{ asset('client/assets/static/videography/previous-arrow.svg') }}" alt="Previous"
                class="w-auto h-auto">
        </button>

        <!-- Đường thẳng phân cách (2px x 40px, màu #CDB88D, khoảng cách hai bên 33px) -->
        <div class="w-[2px] h-[40px] bg-[#CDB88D] mx-[33px]"></div>

        <!-- Nút Next -->
        <button
            class="videography-next-btn cursor-pointer focus:outline-none hover:opacity-70 transition-opacity flex items-center justify-center">
            <img src="{{ asset('client/assets/static/videography/next-arrow.svg') }}" alt="Next"
                class="w-auto h-auto">
        </button>
    </div>
</section>

@push('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiper = new Swiper('.videography-detail-swiper', {
                slidesPerView: 1, // Chỉ hiện duy nhất 1 slide chính
                spaceBetween: 0, // Không tạo khoảng cách hở sườn
                loop: true, // Lặp vô tận
                grabCursor: true, // Hiển thị con trỏ dạng kéo thả
                speed: 600, // Tốc độ chuyển slide mượt mà
                navigation: {
                    nextEl: '.videography-next-btn',
                    prevEl: '.videography-prev-btn',
                },
                keyboard: {
                    enabled: true, // Cho phép điều khiển qua bàn phím
                },
            });
        });
    </script>
@endpush
