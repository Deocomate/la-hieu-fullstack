{{-- resources/views/client/faces-and-places/partials/fap-gallery-item.blade.php --}}
<div class="w-full flex flex-col items-center lg:pb-[60px]">
    <!-- ==========================================
         ALBUM HEADER INFO
         ========================================== -->
    <div class="w-full max-w-[725px] flex flex-col items-center text-center mb-8 lg:mb-[50px]" data-aos="fade-up">
        <!-- Title (36px, Be Vietnam, Bold) -->
        <h2
            class="font-be-vietnam font-extrabold text-[24px] md:text-[28px] lg:text-[36px] text-black uppercase tracking-[1.2px] md:tracking-[2.4px] leading-tight typing-effect">
            {{ $title }}
        </h2>

        <!-- View Album Link (12px, Be Vietnam, Light, Underline) -->
        <a href="{{ $viewAlbumUrl ?? '#' }}"
            class="font-be-vietnam font-light text-[12px] text-black underline mt-2 hover:text-gray-500 transition-colors leading-[22px]">
            View album
        </a>

        <!-- Description (16px, Be Vietnam, Light, Line-height 23px) -->
        <p class="font-be-vietnam font-light text-[14px] lg:text-[16px] leading-[23px] text-black mt-6">
            {{ $description }}
        </p>
    </div>

    <!-- ==========================================
         ALBUM GALLERY GRID (Max-width 1320px)
         Đổi grid-cols-1 sm:grid-cols-2 thành grid-cols-2 cho hiển thị 2 cột trên di động
         ========================================== -->
    <div class="w-full max-w-[1320px] grid grid-cols-2 lg:grid-cols-4 gap-[10px]">

        <!-- COLUMN 1 (Gồm 2 ảnh) -->
        <div class="flex flex-col gap-[10px]" data-aos="fade-up" data-aos-delay="100">
            <!-- Image 1: Tỷ lệ 322x510 -->
            <div class="w-full aspect-[322/510] overflow-hidden group relative cursor-pointer shadow-sm bg-gray-100">
                <img src="{{ asset('client/assets/static/faces-and-places/' . ($images[0] ?? '')) }}"
                    alt="Gallery Image 1"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
            <!-- Image 2: Tỷ lệ 322x451 -->
            <div class="w-full aspect-[322/451] overflow-hidden group relative cursor-pointer shadow-sm bg-gray-100">
                <img src="{{ asset('client/assets/static/faces-and-places/' . ($images[1] ?? '')) }}"
                    alt="Gallery Image 2"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
        </div>

        <!-- COLUMN 2 (Gồm 3 ảnh) -->
        <div class="flex flex-col gap-[10px]" data-aos="fade-up" data-aos-delay="200">
            <!-- Image 3: Tỷ lệ 322x218 -->
            <div class="w-full aspect-[322/218] overflow-hidden group relative cursor-pointer shadow-sm bg-gray-100">
                <img src="{{ asset('client/assets/static/faces-and-places/' . ($images[2] ?? '')) }}"
                    alt="Gallery Image 3"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
            <!-- Image 4: Tỷ lệ 322x504 -->
            <div class="w-full aspect-[322/504] overflow-hidden group relative cursor-pointer shadow-sm bg-gray-100">
                <img src="{{ asset('client/assets/static/faces-and-places/' . ($images[3] ?? '')) }}"
                    alt="Gallery Image 4"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
            <!-- Image 5: Tỷ lệ 322x218 -->
            <div class="w-full aspect-[322/218] overflow-hidden group relative cursor-pointer shadow-sm bg-gray-100">
                <img src="{{ asset('client/assets/static/faces-and-places/' . ($images[4] ?? '')) }}"
                    alt="Gallery Image 5"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
        </div>

        <!-- COLUMN 3 (Gồm 2 ảnh) -->
        <div class="flex flex-col gap-[10px]" data-aos="fade-up" data-aos-delay="300">
            <!-- Image 6: Tỷ lệ 322x451 -->
            <div class="w-full aspect-[322/451] overflow-hidden group relative cursor-pointer shadow-sm bg-gray-100">
                <img src="{{ asset('client/assets/static/faces-and-places/' . ($images[5] ?? '')) }}"
                    alt="Gallery Image 6"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
            <!-- Image 7: Tỷ lệ 322x452 -->
            <div class="w-full aspect-[322/452] overflow-hidden group relative cursor-pointer shadow-sm bg-gray-100">
                <img src="{{ asset('client/assets/static/faces-and-places/' . ($images[6] ?? '')) }}"
                    alt="Gallery Image 7"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
        </div>

        <!-- COLUMN 4 (Gồm 2 ảnh) -->
        <div class="flex flex-col gap-[10px]" data-aos="fade-up" data-aos-delay="400">
            <!-- Image 8: Tỷ lệ 322x598 -->
            <div class="w-full aspect-[322/598] overflow-hidden group relative cursor-pointer shadow-sm bg-gray-100">
                <img src="{{ asset('client/assets/static/faces-and-places/' . ($images[7] ?? '')) }}"
                    alt="Gallery Image 8"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
            <!-- Image 9: Tỷ lệ 322x221 -->
            <div class="w-full aspect-[322/221] overflow-hidden group relative cursor-pointer shadow-sm bg-gray-100">
                <img src="{{ asset('client/assets/static/faces-and-places/' . ($images[8] ?? '')) }}"
                    alt="Gallery Image 9"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
        </div>

    </div>
</div>
