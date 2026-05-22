<section
    class="relative w-full pt-[34px] pb-[71px] md:py-16 lg:pt-[71px] lg:pb-[112px] flex flex-col items-center overflow-hidden">
    <!-- Background Image & Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('client/assets/static/home/event-photography-background.jpg') }}"
            alt="Event Photography Background" class="w-full h-full object-cover">
        <!-- Overlay chuẩn theo design: linear gradient kết hợp với màu đen 40% -->
        <div class="absolute inset-0 bg-black/40"
            style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.50) 0%, rgba(102, 102, 102, 0) 100%);">
        </div>
    </div>

    <!-- Content Wrapper -->
    <!-- Xóa px-4 ở lớp bọc ngoài cùng trên mobile để chia padding riêng biệt cho chữ và khối ảnh (gallery overflow) -->
    <div class="relative z-10 w-full flex flex-col items-center">

        <!-- Header & Description -->
        <!-- Khối văn bản cách lề 30px trên Mobile -->
        <div class="w-full px-[30px] md:px-4 flex flex-col items-center">
            <!-- Section Title -->
            <h2
                class="font-be-vietnam text-[24px] md:text-hero-sm font-extrabold tracking-[2.4px] md:tracking-[4.4px] uppercase text-white text-center typing-effect">
                Event photography
            </h2>

            <!-- Section Description -->
            <!-- Cách title 15px trên mobile -->
            <p class="font-be-vietnam text-[14px] md:text-body-18-wide font-medium tracking-[0.14px] md:tracking-[0.9px] text-white text-center max-w-[750px] mt-[15px] md:mt-4 lg:mt-[40px] text-shadow-image"
                data-aos="fade-up" data-aos-delay="200">
                Even in the middle of a vibrant crowd, I am always looking for the same thing:
                the raw, unscripted moments that define the true character of the event
            </p>
        </div>

        <!-- Cards Grid Container -->
        <!-- Mobile: Dạng scroll ngang (flex-row, overflow-x-auto, snap). Desktop: Dạng Grid -->
        <!-- Cách description 40px, padding hai bên 30px, khoảng cách giữa các khối (gap) 20px -->
        <div
            class="w-full max-w-[1312px] mt-[40px] md:mt-10 lg:mt-[74px] flex flex-row md:grid overflow-x-auto md:overflow-visible snap-x snap-mandatory md:grid-cols-2 lg:grid-cols-4 gap-[20px] md:gap-6 lg:gap-[20px] ml-[50px] md:ml-0 md:px-4 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

            <!-- Card Item 1 -->
            <!-- Giới hạn w-[310px] trên Mobile để có thể lộ card tiếp theo, tạo gợi ý vuốt cho người dùng -->
            <a href="#" class="flex flex-col w-[310px] sm:w-[320px] md:w-full flex-shrink-0 snap-start group"
                data-aos="fade-up" data-aos-delay="100">
                <div class="w-full overflow-hidden shadow-[2px_4px_11px_rgba(0,0,0,0.1)]">
                    <img src="{{ asset('client/assets/static/home/event-photography-1.png') }}" alt="P4G Vietnam Summit"
                        class="w-full aspect-[313/208] object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy">
                </div>
                <!-- Cách ảnh 15px trên Mobile -->
                <span class="font-oswald text-tag font-normal text-white uppercase mt-[15px] md:mt-4">Event</span>
                <h3
                    class="font-be-vietnam text-[16px] md:text-h-card-20-norm font-semibold text-white mt-1 group-hover:text-gray-300 transition-colors">
                    P4G Vietnam Summit</h3>
            </a>

            <!-- Card Item 2 -->
            <a href="#" class="flex flex-col w-[310px] sm:w-[320px] md:w-full flex-shrink-0 snap-start group"
                data-aos="fade-up" data-aos-delay="200">
                <div class="w-full overflow-hidden shadow-[2px_4px_11px_rgba(0,0,0,0.1)]">
                    <img src="{{ asset('client/assets/static/home/event-photography-2.png') }}" alt="Goethe - The Gem"
                        class="w-full aspect-[313/208] object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy">
                </div>
                <!-- Cách ảnh 15px trên Mobile -->
                <span class="font-oswald text-tag font-normal text-white uppercase mt-[15px] md:mt-4">Event</span>
                <h3
                    class="font-be-vietnam text-[16px] md:text-h-card-20-norm font-semibold text-white mt-1 group-hover:text-gray-300 transition-colors">
                    Goethe - The Gem</h3>
            </a>

            <!-- Card Item 3 -->
            <a href="#" class="flex flex-col w-[310px] sm:w-[320px] md:w-full flex-shrink-0 snap-start group"
                data-aos="fade-up" data-aos-delay="300">
                <div class="w-full overflow-hidden shadow-[2px_4px_11px_rgba(0,0,0,0.1)]">
                    <img src="{{ asset('client/assets/static/home/event-photography-3.png') }}" alt="Goethe - The Gem"
                        class="w-full aspect-[313/208] object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy">
                </div>
                <!-- Cách ảnh 15px trên Mobile -->
                <span class="font-oswald text-tag font-normal text-white uppercase mt-[15px] md:mt-4">Event</span>
                <h3
                    class="font-be-vietnam text-[16px] md:text-h-card-20-norm font-semibold text-white mt-1 group-hover:text-gray-300 transition-colors">
                    Goethe - The Gem</h3>
            </a>

            <!-- Card Item 4 -->
            <a href="#" class="flex flex-col w-[310px] sm:w-[320px] md:w-full flex-shrink-0 snap-start group"
                data-aos="fade-up" data-aos-delay="400">
                <div class="w-full overflow-hidden shadow-[2px_4px_11px_rgba(0,0,0,0.1)]">
                    <img src="{{ asset('client/assets/static/home/event-photography-4.png') }}" alt="Goethe - The Gem"
                        class="w-full aspect-[313/208] object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy">
                </div>
                <!-- Cách ảnh 15px trên Mobile -->
                <span class="font-oswald text-tag font-normal text-white uppercase mt-[15px] md:mt-4">Event</span>
                <h3
                    class="font-be-vietnam text-[16px] md:text-h-card-20-norm font-semibold text-white mt-1 group-hover:text-gray-300 transition-colors">
                    Goethe - The Gem</h3>
            </a>

        </div>
    </div>
</section>
