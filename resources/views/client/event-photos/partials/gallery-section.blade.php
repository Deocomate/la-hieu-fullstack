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

    <!-- ==========================================
         MOBILE NAVIGATION HEADER (< md)
         ========================================== -->
    <div class="md:hidden w-full flex flex-col items-center mb-[30px] relative">
        <!-- Navigation Arrows & Title Row -->
        <div class="w-full flex items-center justify-between px-[43px] relative h-[26px]">
            <!-- Prev Arrow (43px from Left) -->
            <button id="mobile-album-prev"
                class="cursor-pointer hover:opacity-70 transition-opacity flex items-center justify-center">
                <img src="{{ asset('client/assets/static/event-photo/prev.svg') }}" alt="Previous" class="w-auto h-[18px]">
            </button>

            <!-- Centered Active Album Title -->
            <h2 id="mobile-album-title"
                class="font-be-vietnam font-bold text-[18px] text-black text-center mx-auto tracking-[0.5px]">
                P4G Vietnam Summit
            </h2>

            <!-- Next Arrow (43px from Right) -->
            <button id="mobile-album-next"
                class="cursor-pointer hover:opacity-70 transition-opacity flex items-center justify-center">
                <img src="{{ asset('client/assets/static/event-photo/next.svg') }}" alt="Next"
                    class="w-auto h-[18px]">
            </button>
        </div>

        <!-- View album link (Căn giữa dưới Title) -->
        <a href="#" id="mobile-album-link"
            class="font-be-vietnam font-light text-[12px] leading-[22px] text-black underline md:mt-2 hover:text-gray-500 transition-colors">
            View album
        </a>
    </div>

    <!-- Main Container: Max width 1145px -->
    <div class="w-full max-w-[1145px] mx-auto flex flex-col md:flex-row md:items-start lg:gap-[172px]">

        <!-- ==========================================
             DESKTOP SIDEBAR (Navigation - Hidden on Mobile)
             ========================================== -->
        <aside class="hidden md:block w-full md:w-max flex-shrink-0 mb-8 md:mb-0 md:sticky md:top-[120px] z-20"
            data-aos="fade-right">

            <ul class="flex flex-row lg:flex-col items-start gap-6 lg:gap-0 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0 px-4 lg:px-0 hide-scrollbar"
                id="album-nav">

                <!-- 1. P4G Vietnam Summit (Mặc định Active) -->
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
                <li class="album-nav-item whitespace-nowrap lg:whitespace-normal lg:mt-[22px]" data-album="goeth">
                    <h3
                        class="album-title font-be-vietnam font-bold text-[16px] leading-[22px] text-gray-400 cursor-pointer hover:text-black transition-colors">
                        Goeth: The Gem
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

                <!-- 3. La Hieu Project -->
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
             GALLERY CONTAINER (2 columns on Mobile, 3 on Desktop)
             ========================================== -->
        <!-- Pl-[30px] & Pr-[27px] chuẩn theo design detail mobile -->
        <div id="gallery-container"
            class="flex-1 w-full columns-2 md:columns-2 lg:columns-3 gap-[10px] pl-[30px] pr-[27px] md:pl-0 md:pr-0">

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

            const albumsData = {
                'p4g': [1, 2, 3, 4, 5, 6, 7, 8],
                'goeth': [9, 10, 11, 12, 13, 14, 15],
                'lahieu': [16, 17, 18, 19, 1, 3, 6]
            };

            const albumTitles = {
                'p4g': 'P4G Vietnam Summit',
                'goeth': 'Goeth: The Gem',
                'lahieu': 'La Hieu Project'
            };

            const albumKeys = ['p4g', 'goeth', 'lahieu'];
            let currentAlbumIndex = 0;

            const assetBaseUrl = "{{ asset('client/assets/static/event-photo/gallery-') }}";

            const navItems = document.querySelectorAll('.album-nav-item');
            const galleryContainer = document.getElementById('gallery-container');
            const mobileTitle = document.getElementById('mobile-album-title');

            // Hàm xử lý kích hoạt Album (Đồng bộ Desktop Sidebar và Mobile Header)
            function setActiveAlbum(albumKey) {
                currentAlbumIndex = albumKeys.indexOf(albumKey);
                if (currentAlbumIndex === -1) currentAlbumIndex = 0;

                const activeKey = albumKeys[currentAlbumIndex];

                // 1. Cập nhật UI Sidebar (Desktop)
                navItems.forEach(nav => {
                    const key = nav.getAttribute('data-album');
                    if (key === activeKey) {
                        nav.classList.add('relative');
                        const activeTitle = nav.querySelector('.album-title');
                        activeTitle.classList.remove('text-gray-400');
                        activeTitle.classList.add('text-black');

                        nav.querySelector('.album-link').classList.remove('hidden');
                        nav.querySelector('.album-link').classList.add('block');
                        nav.querySelector('.album-line').classList.remove('hidden');
                        nav.querySelector('.album-line').classList.add('lg:block');
                    } else {
                        nav.classList.remove('relative');
                        const title = nav.querySelector('.album-title');
                        title.classList.remove('text-black');
                        title.classList.add('text-gray-400');

                        nav.querySelector('.album-link').classList.add('hidden');
                        nav.querySelector('.album-link').classList.remove('block');
                        nav.querySelector('.album-line').classList.add('hidden');
                        nav.querySelector('.album-line').classList.remove('lg:block');
                    }
                });

                // 2. Cập nhật UI Header (Mobile)
                if (mobileTitle) {
                    mobileTitle.textContent = albumTitles[activeKey];
                }

                // 3. Render khối ảnh
                renderGallery(activeKey);
            }

            // Sự kiện Click chọn Album trên Desktop Sidebar
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    if (e.target.tagName.toLowerCase() === 'a') return;
                    const albumKey = this.getAttribute('data-album');
                    setActiveAlbum(albumKey);
                });
            });

            // Sự kiện Click nút Prev trên Mobile Header
            const btnPrev = document.getElementById('mobile-album-prev');
            if (btnPrev) {
                btnPrev.addEventListener('click', function() {
                    currentAlbumIndex = (currentAlbumIndex - 1 + albumKeys.length) % albumKeys.length;
                    setActiveAlbum(albumKeys[currentAlbumIndex]);
                });
            }

            // Sự kiện Click nút Next trên Mobile Header
            const btnNext = document.getElementById('mobile-album-next');
            if (btnNext) {
                btnNext.addEventListener('click', function() {
                    currentAlbumIndex = (currentAlbumIndex + 1) % albumKeys.length;
                    setActiveAlbum(albumKeys[currentAlbumIndex]);
                });
            }

            function renderGallery(albumKey) {
                const images = albumsData[albumKey];

                galleryContainer.style.opacity = '0';

                setTimeout(() => {
                    galleryContainer.innerHTML = '';

                    let htmlContent = '';
                    images.forEach((imgNumber, index) => {
                        const delay = index * 0.1;
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
                    galleryContainer.style.opacity = '1';

                }, 300);
            }
        });
    </script>
@endpush
