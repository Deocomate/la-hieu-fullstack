<section class="w-full bg-white px-[30px] md:px-[25px] pb-[50px] md:py-[50px]">

    <!-- ==========================================
         MOBILE/TABLET GALLERY (< lg)
         Dạng Columns Masonry tự động sát cạnh nhau, không có khoảng trắng
         ========================================== -->
    <div class="lg:hidden w-full columns-2 gap-[10px]" data-aos="fade-up">
        @php
            $images = [
                'gallery-grid-1.png',
                'gallery-grid-2.png',
                'gallery-grid-3.png',
                'gallery-grid-4.png',
                'gallery-grid-5.png',
                'gallery-grid-6.png',
                'gallery-grid-7.png',
                'gallery-grid-8.png',
            ];
        @endphp

        @foreach ($images as $index => $imgName)
            <!-- mb-[10px] tạo khoảng cách dọc chính xác 10px giữa các ảnh xếp chồng -->
            <div class="w-full mb-[10px] break-inside-avoid overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ asset('client/assets/static/event-photo/' . $imgName) }}"
                    alt="Gallery Grid Image {{ $index + 1 }}"
                    class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
        @endforeach
    </div>

    <!-- ==========================================
         DESKTOP GALLERY (>= lg)
         Chiều cao Desktop cố định chuẩn 340px, flex co giãn tỉ lệ ban đầu
         ========================================== -->
    <div class="hidden lg:flex lg:flex-col lg:gap-[15px] w-full">

        <!-- ROW 1 -->
        <div class="flex flex-nowrap gap-[15px] w-full h-[340px]" data-aos="fade-up">

            <!-- Image 1 (Width ~500) -->
            <div class="w-auto [flex:500] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ asset('client/assets/static/event-photo/gallery-grid-1.png') }}" alt="Gallery Image 1"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <!-- Image 2 (Width ~242) -->
            <div class="w-auto [flex:242] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ asset('client/assets/static/event-photo/gallery-grid-2.png') }}" alt="Gallery Image 2"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <!-- Image 3 (Width ~497) -->
            <div class="w-auto [flex:497] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ asset('client/assets/static/event-photo/gallery-grid-3.png') }}" alt="Gallery Image 3"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <!-- Image 4 (Width ~242) -->
            <div class="w-auto [flex:242] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ asset('client/assets/static/event-photo/gallery-grid-4.png') }}" alt="Gallery Image 4"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

        </div>

        <!-- ROW 2 -->
        <div class="flex flex-nowrap gap-[15px] w-full h-[340px]" data-aos="fade-up" data-aos-delay="150">

            <!-- Image 5 (Width ~218) -->
            <div class="w-auto [flex:218] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ asset('client/assets/static/event-photo/gallery-grid-5.png') }}" alt="Gallery Image 5"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <!-- Image 6 (Width ~502) -->
            <div class="w-auto [flex:502] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ asset('client/assets/static/event-photo/gallery-grid-6.png') }}" alt="Gallery Image 6"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <!-- Image 7 (Width ~183) -->
            <div class="w-auto [flex:183] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ asset('client/assets/static/event-photo/gallery-grid-7.png') }}" alt="Gallery Image 7"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <!-- Image 8 (Width ~497) -->
            <div class="w-auto [flex:497] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ asset('client/assets/static/event-photo/gallery-grid-8.png') }}" alt="Gallery Image 8"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

        </div>

    </div>
</section>
