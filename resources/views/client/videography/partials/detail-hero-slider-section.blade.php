{{-- resources/views/client/videography/partials/detail-hero-slider-section.blade.php --}}
@push('styles')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        /* Tùy chỉnh kích thước khung slider theo chuẩn thiết kế (1420px x 685px) trên Desktop */
        .videography-detail-swiper {
            width: 100%;
            max-width: 1420px;
            height: 685px;
            margin-left: auto;
            margin-right: auto;
        }

        .videography-detail-swiper .swiper-slide {
            width: 100%;
            height: 100%;
        }

        /* Tự động responsive tỉ lệ khung hình trên tablet & laptop nhỏ */
        @media (max-width: 1420px) {
            .videography-detail-swiper {
                height: 48.24vw;
                max-height: 685px;
            }
        }

        @media (max-width: 1024px) {
            .videography-detail-swiper {
                height: 55vw;
            }
        }

        /* Thiết lập kích thước cố định chuẩn xác cho Mobile (< 768px) theo Design Detail */
        @media (max-width: 767px) {
            .videography-detail-swiper {
                width: 369px !important;
                height: 208px !important;
            }
        }

        /* Chỉnh nhẹ z-index để nút play hiển thị rõ ràng */
        .video-play-btn {
            z-index: 10;
        }
    </style>
@endpush

<section class="w-full bg-white overflow-hidden md:py-0" data-aos="fade-up">
    <!--
        Container bọc ngoài:
        - Trên di động: Xếp theo hàng ngang (Left Arrow -> Media Frame -> Right Arrow)
        - Trên Desktop: Block bình thường theo cấu trúc gốc của bạn
    -->
    <div class="relative w-full flex items-center justify-center gap-2 md:block">

        <!-- Mobile Left Navigation Arrow (Ẩn trên Desktop) -->
        <button
            class="videography-prev-btn md:hidden cursor-pointer focus:outline-none hover:opacity-70 transition-opacity flex items-center justify-center p-2 shrink-0">
            <img src="{{ asset('client/assets/static/videography/previous-arrow.svg') }}" alt="Previous"
                class="w-auto h-auto">
        </button>

        <!-- Swiper Container -->
        <div class="swiper videography-detail-swiper">
            <div class="swiper-wrapper">
                @php
                    $youtubeVideos = [
                        'LXb3EKWsInQ',
                        'Qs2-klYtq5Y',
                        'LXb3EKWsInQ', // Giữ nguyên loop slide
                    ];
                @endphp

                @foreach ($youtubeVideos as $index => $videoId)
                    <!-- Swiper Slide -->
                    <div class="swiper-slide overflow-hidden shadow-sm bg-[#111]">
                        <!--
                            Cơ chế Load-on-click:
                            Ban đầu hiển thị ảnh bìa (thumbnail) của YouTube
                        -->
                        <div class="video-placeholder relative w-full h-full cursor-pointer group"
                            data-video-id="{{ $videoId }}">
                            <!-- Thumbnail mặc định của Youtube -->
                            <img src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg"
                                alt="Videography Detail Slide {{ $index + 1 }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                            <!-- Lớp phủ tối nhẹ (Overlay) -->
                            <div
                                class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-500">
                            </div>

                            <!-- Nút Play overlay đặt chính giữa sử dụng asset SVG thống nhất -->
                            <div
                                class="video-play-btn absolute inset-0 flex items-center justify-center pointer-events-none">
                                <img src="{{ asset('client/assets/static/videography/play-button.svg') }}"
                                    alt="Play"
                                    class="w-[52px] h-[52px] md:w-[64px] md:h-[64px] object-contain transition-transform duration-300 group-hover:scale-110">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Mobile Right Navigation Arrow (Ẩn trên Desktop) -->
        <button
            class="videography-next-btn md:hidden cursor-pointer focus:outline-none hover:opacity-70 transition-opacity flex items-center justify-center p-2 shrink-0">
            <img src="{{ asset('client/assets/static/videography/next-arrow.svg') }}" alt="Next"
                class="w-auto h-auto">
        </button>

    </div>

    <!-- Thanh điều hướng custom phía dưới Slider (Chỉ hiển thị trên Desktop >= md) -->
    <div class="hidden md:flex items-center justify-center mt-6" data-aos="fade-up" data-aos-delay="200">
        <!-- Nút Previous -->
        <button
            class="videography-prev-btn cursor-pointer focus:outline-none hover:opacity-70 transition-opacity flex items-center justify-center p-2">
            <img src="{{ asset('client/assets/static/videography/previous-arrow.svg') }}" alt="Previous"
                class="w-auto h-auto">
        </button>

        <!-- Đường thẳng phân cách (2px x 40px, màu #CDB88D, khoảng cách hai bên 33px) -->
        <div class="w-[2px] h-[40px] bg-[#CDB88D] mx-[33px]"></div>

        <!-- Nút Next -->
        <button
            class="videography-next-btn cursor-pointer focus:outline-none hover:opacity-70 transition-opacity flex items-center justify-center p-2">
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
            // Khởi tạo Swiper
            const swiper = new Swiper('.videography-detail-swiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                grabCursor: true,
                speed: 600,
                navigation: {
                    nextEl: '.videography-next-btn',
                    prevEl: '.videography-prev-btn',
                },
                keyboard: {
                    enabled: true,
                },
                // Khi chuyển đổi slide, dừng video đang phát và hiển thị lại thumbnail cùng nút play SVG
                on: {
                    slideChangeTransitionStart: function() {
                        document.querySelectorAll('.video-placeholder').forEach(wrapper => {
                            if (wrapper.querySelector('iframe')) {
                                const videoId = wrapper.getAttribute('data-video-id');
                                wrapper.innerHTML = `
                                    <img src="https://img.youtube.com/vi/${videoId}/maxresdefault.jpg" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors duration-500"></div>
                                    <div class="video-play-btn absolute inset-0 flex items-center justify-center pointer-events-none">
                                        <img src="{{ asset('client/assets/static/videography/play-button.svg') }}" alt="Play" class="w-[52px] h-[52px] md:w-[64px] md:h-[64px] object-contain transition-transform duration-300 group-hover:scale-110">
                                    </div>
                                `;
                            }
                        });
                    }
                }
            });

            // Xử lý sự kiện click vào ảnh bìa để tải và tự động phát iframe Youtube
            document.querySelector('.videography-detail-swiper').addEventListener('click', function(e) {
                const placeholder = e.target.closest('.video-placeholder');

                if (placeholder && !placeholder.querySelector('iframe')) {
                    const videoId = placeholder.getAttribute('data-video-id');
                    const iframe = document.createElement('iframe');

                    iframe.setAttribute('src', `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`);
                    iframe.setAttribute('frameborder', '0');
                    iframe.setAttribute('allow',
                        'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
                    );
                    iframe.setAttribute('allowfullscreen', '1');
                    iframe.classList.add('w-full', 'h-full', 'absolute', 'inset-0', 'z-50');

                    placeholder.innerHTML = '';
                    placeholder.appendChild(iframe);
                }
            });
        });
    </script>
@endpush
