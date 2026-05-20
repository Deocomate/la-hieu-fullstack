<section class="w-full bg-white pt-10 lg:pt-[40px] pb-20 lg:pb-[100px] px-4 flex flex-col items-center overflow-hidden">

    <!-- Section Title -->
    <!-- Dùng text-[24px], font-extrabold (800) và tracking-[2.4px] từ thông số Figma -->
    <h2
        class="font-be-vietnam font-extrabold text-[20px] md:text-[24px] text-black text-center uppercase tracking-[2.4px] leading-snug typing-effect">
        I don't walk this road alone<br class="hidden md:inline" />
        Meet the partners who let me capture their journey
    </h2>

    <!-- Partners Grid Container -->
    <!-- Max width 1320px. Tính toán thiết kế: 4 hình (291px) + 3 gaps (52px) = 1164 + 156 = 1320px -->
    <!-- Khoảng cách mt-[87px] tính từ Title xuống Grid -->
    <div
        class="w-full max-w-[1320px] mt-10 lg:mt-[87px] grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-[52px] justify-items-center">

        @for ($i = 1; $i <= 4; $i++)
            <!-- Partner Item -->
            <!-- Giới hạn w-max 291px, tự động bo tròn (rounded-full) tỷ lệ 1:1 (aspect-square) -->
            <div
                class="w-full max-w-[291px] aspect-square bg-[#D9D9D9] rounded-full overflow-hidden flex items-center justify-center shadow-sm hover:shadow-xl transition-shadow cursor-pointer group"
                data-aos="zoom-out" data-aos-delay="{{ $i * 100 }}">

                <!-- Ảnh Partner -->
                <img src="{{ asset('client/assets/static/home/partner-' . $i . '.png') }}"
                    alt="Partner {{ $i }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    loading="lazy">

            </div>
        @endfor

    </div>

</section>
