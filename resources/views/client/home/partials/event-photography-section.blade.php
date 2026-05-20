<section class="relative w-full py-16 lg:pt-[71px] lg:pb-[112px] flex flex-col items-center overflow-hidden">
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
    <div class="relative z-10 w-full px-4 flex flex-col items-center">

        <!-- Section Title -->
        <!-- Dùng text-heading (44px) và tracking-heading (4.4px) từ config -->
        <h2
            class="font-be-vietnam font-extrabold text-3xl lg:text-heading uppercase tracking-heading text-white text-center typing-effect">
            Event photography
        </h2>

        <!-- Section Description -->
        <!-- Dùng text-desc (18px), tracking-desc (0.9px) và class text-shadow-image từ css config -->
        <p
            class="font-be-vietnam font-medium text-base lg:text-desc tracking-desc text-white text-center max-w-[750px] mt-4 lg:mt-[40px] text-shadow-image" data-aos="fade-up" data-aos-delay="200">
            Even in the middle of a vibrant crowd, I am always looking for the same thing:
            the raw, unscripted moments that define the true character of the event
        </p>

        <!-- Cards Grid Container -->
        <!-- Max width 1312px. Tính toán gap: (1312 - (313 * 4)) / 3 = 20px -->
        <div
            class="w-full max-w-[1312px] mt-10 lg:mt-[74px] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-[20px]">

            <!-- Card Item 1 -->
            <a href="#" class="flex flex-col w-full group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-full overflow-hidden shadow-[2px_4px_11px_rgba(0,0,0,0.1)]">
                    <img src="{{ asset('client/assets/static/home/event-photography-1.png') }}" alt="P4G Vietnam Summit"
                        class="w-full aspect-[313/208] object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy">
                </div>
                <span class="font-oswald font-normal text-base text-white uppercase tracking-tag mt-4">Event</span>
                <h3
                    class="font-be-vietnam font-semibold text-sub text-white mt-1 group-hover:text-gray-300 transition-colors">
                    P4G Vietnam Summit</h3>
            </a>

            <!-- Card Item 2 -->
            <a href="#" class="flex flex-col w-full group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-full overflow-hidden shadow-[2px_4px_11px_rgba(0,0,0,0.1)]">
                    <img src="{{ asset('client/assets/static/home/event-photography-2.png') }}" alt="Goethe - The Gem"
                        class="w-full aspect-[313/208] object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy">
                </div>
                <span class="font-oswald font-normal text-base text-white uppercase tracking-tag mt-4">Event</span>
                <h3
                    class="font-be-vietnam font-semibold text-sub text-white mt-1 group-hover:text-gray-300 transition-colors">
                    Goethe - The Gem</h3>
            </a>

            <!-- Card Item 3 -->
            <a href="#" class="flex flex-col w-full group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-full overflow-hidden shadow-[2px_4px_11px_rgba(0,0,0,0.1)]">
                    <img src="{{ asset('client/assets/static/home/event-photography-3.png') }}" alt="Goethe - The Gem"
                        class="w-full aspect-[313/208] object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy">
                </div>
                <span class="font-oswald font-normal text-base text-white uppercase tracking-tag mt-4">Event</span>
                <h3
                    class="font-be-vietnam font-semibold text-sub text-white mt-1 group-hover:text-gray-300 transition-colors">
                    Goethe - The Gem</h3>
            </a>

            <!-- Card Item 4 -->
            <a href="#" class="flex flex-col w-full group" data-aos="fade-up" data-aos-delay="400">
                <div class="w-full overflow-hidden shadow-[2px_4px_11px_rgba(0,0,0,0.1)]">
                    <img src="{{ asset('client/assets/static/home/event-photography-4.png') }}" alt="Goethe - The Gem"
                        class="w-full aspect-[313/208] object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy">
                </div>
                <span class="font-oswald font-normal text-base text-white uppercase tracking-tag mt-4">Event</span>
                <h3
                    class="font-be-vietnam font-semibold text-sub text-white mt-1 group-hover:text-gray-300 transition-colors">
                    Goethe - The Gem</h3>
            </a>

        </div>
    </div>
</section>
