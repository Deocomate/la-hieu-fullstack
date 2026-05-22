<!-- Thêm overflow-hidden ở mobile để cho phép vuốt ảnh tràn viền, xoá padding mặc định -->
<section
    class="w-full bg-white px-0 md:px-4 lg:px-[31px] pt-12 lg:pt-[80px] pb-12 lg:pb-[55px] flex flex-col items-center overflow-hidden md:overflow-visible">

    <!-- Section Title -->
    <!-- Bổ sung px-[30px] trên mobile để căn đúng lề -->
    <h2
        class="font-be-vietnam text-[24px] md:text-hero-sm font-extrabold tracking-[2.4px] md:tracking-[4.4px] uppercase text-black text-center typing-effect px-[30px] md:px-0">
        faces & places
    </h2>

    <!-- Horizontal Scroll & Masonry Grid Container -->
    <!-- Mobile: Flexbox cột ngang với h-[560px], vuốt trái phải (overflow-x-auto), lề trái 30px.
         Desktop: Khôi phục lại khối hiển thị Masonry Columns (md:block md:columns-4...) -->
    <div
        class="w-full mt-10 lg:mt-[80px] md:mx-auto
                flex flex-col md:block flex-wrap content-start
                h-[560px] md:h-auto
                overflow-x-auto overflow-y-hidden md:overflow-visible
                gap-x-[10px] md:gap-[12px]
                ml-[50px] md:ml-0
                snap-x snap-mandatory md:snap-none
                md:columns-4 lg:columns-6 xl:columns-8
                [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]
                after:content-[''] after:w-[30px] md:after:hidden after:h-full after:shrink-0">

        @php
            $totalImages = 19;
        @endphp

        @for ($i = 1; $i <= $totalImages; $i++)
            <!-- Item của Ảnh -->
            <!-- Mobile: Giới hạn chiều rộng w-[260px] để bắt buộc rớt hàng trong vùng 560px, margin-bottom 10px -->
            <div class="w-[180px] md:w-full break-inside-avoid snap-start mb-[10px] md:mb-3 lg:mb-[12px] overflow-hidden shadow-sm group cursor-pointer relative bg-gray-100 rounded-sm"
                data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 100 }}">

                <img src="{{ asset('client/assets/static/home/faces-and-places-' . $i . '.png') }}"
                    alt="Faces and Places {{ $i }}"
                    class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-110"
                    loading="lazy">

                <!-- Hiệu ứng overlay nhẹ khi hover -->
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
        @endfor

    </div>

    <!-- Section Description -->
    <!-- Bổ sung px-[30px] trên mobile để căn đúng lề -->
    <p class="font-be-vietnam text-[14px] md:text-body-18-wide font-light tracking-[0.14px] md:tracking-[0.9px] text-black text-center max-w-[728px] mt-10 lg:mt-[61px] mx-auto px-[30px] md:px-0"
        data-aos="fade-up">
        This collection is a visual diary of the roads I have traveled and the people<br class="hidden md:inline" />
        I have met. More than just coordinates or portraits, these images preserve<br class="hidden md:inline" />
        the raw, real emotions of a specific fraction in time.
    </p>

</section>
