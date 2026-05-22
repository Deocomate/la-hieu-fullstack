<!-- resources/views/client/home/partials/partners-section.blade.php -->
<section
    class="w-full bg-white pt-10 lg:pt-[40px] pb-[50px] md:pb-20 lg:pb-[100px] px-0 md:px-4 flex flex-col items-center overflow-hidden">

    <!-- Section Title -->
    <!-- Căn lề trái/phải 30px trên di động, căn giữa văn bản và chia 3 dòng text dọc -->
    <h2
        class="px-[30px] md:px-0 font-be-vietnam text-[18px] md:text-h-sub-24-wide font-extrabold tracking-[0.9px] md:tracking-[2.4px] text-black text-center uppercase typing-effect">
        I don't walk this road alone<br class="md:hidden" /><br class="hidden md:inline" />
        Meet the partners who let me<br class="md:hidden" /><span class="hidden md:inline"> </span>capture their journey
    </h2>

    <!-- Partners Grid/Carousel Container -->
    <!-- Mobile: Tự động cuộn ngang (flex-row overflow-x-auto), lề trái/phải 30px, khoảng cách giữa các logo 16px -->
    <!-- Desktop: Trở về dạng Grid 4 cột nguyên bản -->
    <div
        class="w-full max-w-[1320px] ml-[50px] mt-[50px] md:mt-[87px] flex flex-row md:grid overflow-x-auto md:overflow-visible snap-x snap-mandatory md:grid-cols-4 gap-[16px] md:gap-6 lg:gap-[52px] md:px-0 justify-items-center items-start [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

        @for ($i = 1; $i <= 4; $i++)
            <!-- Partner Item -->
            <!-- Mobile: Giới hạn kích thước 147x147px, bo tròn, nền trắng, không shadow -->
            <!-- Desktop: Giữ nguyên kích thước max-w-[291px] và màu nền setup cũ, không shadow -->
            <div class="w-[147px] h-[147px] md:w-full md:max-w-[291px] aspect-square flex-shrink-0 snap-start bg-white md:bg-[#D9D9D9] rounded-full overflow-hidden flex items-center justify-center cursor-pointer"
                data-aos="zoom-out" data-aos-delay="{{ $i * 100 }}">

                <!-- Ảnh Partner - Hiển thị chuẩn kích thước ban đầu, không phóng to hay tạo chuyển động khi hover -->
                <img src="{{ asset('client/assets/static/home/partner-' . $i . '.png') }}"
                    alt="Partner {{ $i }}" class="w-full h-full object-cover" loading="lazy">

            </div>
        @endfor

    </div>

</section>
