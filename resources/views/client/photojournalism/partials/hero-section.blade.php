<section
    class="relative w-full bg-white overflow-hidden pt-16 lg:pt-[80px] pb-12 lg:pb-[80px] flex flex-col items-center">

    <!-- ==========================================
         BACKGROUND LAYER (Chữ chìm SVG)
         ========================================== -->
    <!-- Căn giữa tuyệt đối, không cho phép click/bôi đen để tránh ảnh hưởng UX -->
    <div
        class="absolute top-[0px] lg:top-[0px] left-1/2 -translate-x-1/2 w-max flex items-center gap-[5px] lg:gap-[15px] z-0 pointer-events-none select-none opacity-80">

        <!-- Chữ EVENT -->
        <img src="{{ asset('client/assets/static/photojournalism/photojournalism-hero-background-text.svg') }}" alt="E"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
    </div>

    <!-- ==========================================
         FOREGROUND LAYER (Nội dung hiển thị)
         ========================================== -->
    <div class="relative z-10 w-full px-4 flex flex-col items-center">

        <!-- Heading Chính -->
        <h1
            class="font-be-vietnam font-extrabold text-[44px] md:text-[60px] lg:text-[75px] text-black uppercase text-center leading-none tracking-tight typing-effect">
            PHOTOJOURNALISM
        </h1>

        <!-- Subtitle -->
        <!-- mt-[32px] dựa theo tính toán khoảng cách từ bottom của H1 xuống Subtitle -->
        <p
            class="font-be-vietnam font-light text-[14px] lg:text-[16px] text-black text-center mt-6 lg:mt-[15px] leading-[22px]" data-aos="fade-up" data-aos-delay="200">
            Unposed emotions. The true pulse of the event
        </p>

        <!-- Vertical Divider (Đường kẻ màu vàng/nâu nhạt) -->
        <!-- Logic 84.43px tổng gap: line cao 38px, cách trên 22px, cách dưới 24px => 22 + 38 + 24.43 = ~84.43px -->
        <div class="w-[2px] h-[38px] bg-[#C5AA82] mt-[22px]" data-aos="fade-up" data-aos-delay="300"></div>

    </div>
</section>
