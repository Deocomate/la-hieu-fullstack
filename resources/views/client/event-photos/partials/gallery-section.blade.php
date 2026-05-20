@push('styles')
    <style>
        /* Ẩn thanh cuộn xấu xí trên Mobile cho menu */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Hiệu ứng chuyển đổi gallery */
        #gallery-container {
            transition: opacity 0.3s ease-in-out;
        }

        /* Hiệu ứng bay lên nhẹ cho từng ảnh khi load */
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

<section class="w-full bg-white pb-16 lg:pb-[100px] flex flex-col items-center">

    <!-- Main Container: Max width 1145px -->
    <div class="w-full max-w-[1145px] px-4 mx-auto flex flex-col lg:flex-row lg:items-start lg:gap-[172px]">

        <!-- ==========================================
             LEFT SIDEBAR (Navigation)
             ========================================== -->
        <aside class="w-full lg:w-max flex-shrink-0 mb-8 lg:mb-0 lg:sticky lg:top-[120px] z-20" data-aos="fade-right">

            <ul class="flex flex-row lg:flex-col items-start gap-6 lg:gap-0 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0 hide-scrollbar"
                id="album-nav">

                <!-- 1. P4G Vietnam Summit (Mặc định Active) -->
                <!-- Thêm data-album="p4g" -->
                <li class="album-nav-item relative whitespace-nowrap lg:whitespace-normal group" data-album="p4g">
                    <h3
                        class="album-title font-be-vietnam font-bold text-[16px] leading-[22px] text-black cursor-pointer hover:opacity-70 transition-opacity">
                        P4G Vietnam Summit
                    </h3>

                    <a href="#"
                        class="album-link font-be-vietnam font-light text-[12px] leading-[22px] text-black underline block lg:-mt-[2px] hover:text-gray-500 transition-colors">
                        View album
                    </a>

                    <!-- Mid-line -->
                    <div class="album-line hidden lg:block absolute top-[11px] left-[105%] ml-[15px]">
                        <img src="{{ asset('client/assets/static/event-photo/gallery-mid-line.svg') }}" alt="Line"
                            class="w-auto h-auto min-w-[120px] opacity-70">
                    </div>
                </li>

                <!-- 2. Goeth: The Gem -->
                <!-- Thêm data-album="goeth" -->
                <li class="album-nav-item whitespace-nowrap lg:whitespace-normal lg:mt-[22px]" data-album="goeth">
                    <h3
                        class="album-title font-be-vietnam font-bold text-[16px] leading-[22px] text-gray-400 cursor-pointer hover:text-black transition-colors">
                        Goeth: The Gem
                    </h3>

                    <!-- Ẩn mặc định bằng class hidden -->
                    <a href="#"
                        class="album-link hidden font-be-vietnam font-light text-[12px] leading-[22px] text-black underline lg:-mt-[2px] hover:text-gray-500 transition-colors">
                        View album
                    </a>

                    <!-- Ẩn mặc định bằng class hidden -->
                    <div class="album-line hidden absolute top-[11px] left-[105%] ml-[15px]">
                        <img src="{{ asset('client/assets/static/event-photo/gallery-mid-line.svg') }}" alt="Line"
                            class="w-auto h-auto min-w-[120px] opacity-70">
                    </div>
                </li>

                <!-- 3. La Hieu Project -->
                <!-- Thêm data-album="lahieu" -->
                <li class="album-nav-item whitespace-nowrap lg:whitespace-normal lg:mt-[20px]" data-album="lahieu">
                    <h3
                        class="album-title font-be-vietnam font-bold text-[16px] leading-[22px] text-gray-400 cursor-pointer hover:text-black transition-colors">
                        La Hieu Project
                    </h3>

                    <a href="#"
                        class="album-link hidden font-be-vietnam font-light text-[12px] leading-[22px] text-black underline lg:-mt-[2px] hover:text-gray-500 transition-colors">
                        View album
                    </a>

                    <div class="album-line hidden absolute top-[11px] left-[105%] ml-[15px]">
                        <img src="{{ asset('client/assets/static/event-photo/gallery-mid-line.svg') }}" alt="Line"
                            class="w-auto h-auto min-w-[120px] opacity-70">
                    </div>
                </li>

            </ul>
        </aside>

        <!-- ==========================================
             RIGHT GALLERY (Masonry Grid)
             ========================================== -->
        <!-- Đặt ID gallery-container để JS trỏ tới -->
        <div id="gallery-container" class="flex-1 w-full columns-1 sm:columns-2 lg:columns-3 gap-[10px]">

            <!-- Default Load (Album 1) -->
            @php
                $defaultImages = [1, 2, 3, 4, 5, 6, 7, 8];
            @endphp

            @foreach ($defaultImages as $i)
                <div class="w-full mb-[10px] break-inside-avoid overflow-hidden bg-gray-100 group cursor-pointer relative shadow-[0_2px_8px_rgba(0,0,0,0.05)] animate-fade-in-up"
                    style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <img src="{{ asset('client/assets/static/event-photo/gallery-' . $i . '.png') }}"
                        alt="Gallery Image {{ $i }}"
                        class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                        loading="lazy">
                    <div
                        class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // --- 1. DATA CỦA CÁC ALBUM (Mô phỏng Backend) ---
            // Chia 19 bức ảnh ra làm 3 albums
            const albumsData = {
                'p4g': [1, 2, 3, 4, 5, 6, 7, 8],
                'goeth': [9, 10, 11, 12, 13, 14, 15],
                'lahieu': [16, 17, 18, 19, 1, 3, 6] // Lấy ảnh 16-19 và mix lại một số ảnh cho đủ lưới
            };

            const assetBaseUrl = "{{ asset('client/assets/static/event-photo/gallery-') }}";

            const navItems = document.querySelectorAll('.album-nav-item');
            const galleryContainer = document.getElementById('gallery-container');

            // --- 2. SỰ KIỆN CLICK MENU ---
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    // Nếu click vào thẻ A (View Album) thì không chạy hàm render ảnh
                    if (e.target.tagName.toLowerCase() === 'a') return;

                    const albumKey = this.getAttribute('data-album');

                    // A. Xóa trạng thái Active của tất cả các Nav Items
                    navItems.forEach(nav => {
                        nav.classList.remove('relative');

                        // Reset tiêu đề về xám
                        const title = nav.querySelector('.album-title');
                        title.classList.remove('text-black');
                        title.classList.add('text-gray-400');

                        // Ẩn Link & Đường Line
                        nav.querySelector('.album-link').classList.add('hidden');
                        nav.querySelector('.album-link').classList.remove('block');
                        nav.querySelector('.album-line').classList.add('hidden');
                        nav.querySelector('.album-line').classList.remove('lg:block');
                    });

                    // B. Kích hoạt trạng thái Active cho Item được Click
                    this.classList.add('relative');

                    const activeTitle = this.querySelector('.album-title');
                    activeTitle.classList.remove('text-gray-400');
                    activeTitle.classList.add('text-black');

                    // Hiện Link & Đường Line
                    this.querySelector('.album-link').classList.remove('hidden');
                    this.querySelector('.album-link').classList.add('block');
                    this.querySelector('.album-line').classList.remove('hidden');
                    this.querySelector('.album-line').classList.add('lg:block');

                    // C. Render Gallery
                    renderGallery(albumKey);
                });
            });

            // --- 3. HÀM RENDER HTML GALLERY ---
            function renderGallery(albumKey) {
                const images = albumsData[albumKey];

                // Làm mờ gallery hiện tại để chuẩn bị đổi
                galleryContainer.style.opacity = '0';

                // Đợi 300ms (Bằng thời gian mờ đi) rồi mới chèn DOM mới
                setTimeout(() => {
                    galleryContainer.innerHTML = '';

                    let htmlContent = '';
                    images.forEach((imgNumber, index) => {
                        const delay = index * 0.1; // Tạo độ trễ xếp tầng cho mượt
                        htmlContent += `
                        <div class="w-full mb-[10px] break-inside-avoid overflow-hidden bg-gray-100 group cursor-pointer relative shadow-[0_2px_8px_rgba(0,0,0,0.05)] animate-fade-in-up" style="animation-delay: ${delay}s">
                            <img 
                                src="${assetBaseUrl}${imgNumber}.png" 
                                alt="Gallery Image ${imgNumber}" 
                                class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105" 
                                loading="lazy"
                            >
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none"></div>
                        </div>
                    `;
                    });

                    galleryContainer.innerHTML = htmlContent;

                    // Hiển thị lại container
                    galleryContainer.style.opacity = '1';

                }, 300);
            }
        });
    </script>
@endpush
