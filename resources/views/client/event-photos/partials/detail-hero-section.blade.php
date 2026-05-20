<section
    class="relative w-full bg-white overflow-hidden pt-16 lg:pt-[80px] pb-12 lg:pb-[80px] flex flex-col items-center">

    <!-- ==========================================
         BACKGROUND LAYER (Chữ chìm SVG)
         ========================================== -->
    <!-- Căn giữa tuyệt đối, không cho phép click/bôi đen để tránh ảnh hưởng UX -->
    <div
        class="absolute top-[0px] lg:top-[0px] left-1/2 -translate-x-1/2 w-max flex items-center gap-[5px] lg:gap-[15px] z-0 pointer-events-none select-none opacity-80">

        <!-- Chữ EVENT -->
        <img src="{{ asset('client/assets/static/event-photo/hero-character-e-1.svg') }}" alt="E"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
        <img src="{{ asset('client/assets/static/event-photo/hero-character-v.svg') }}" alt="V"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
        <img src="{{ asset('client/assets/static/event-photo/hero-character-e-2.svg') }}" alt="E"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
        <img src="{{ asset('client/assets/static/event-photo/hero-character-n.svg') }}" alt="N"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
        <img src="{{ asset('client/assets/static/event-photo/hero-character-t-1.svg') }}" alt="T"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">

        <!-- Khoảng trắng giữa 2 chữ -->
        <div class="w-[20px] lg:w-[40px]"></div>

        <!-- Chữ PHOTOS -->
        <img src="{{ asset('client/assets/static/event-photo/hero-character-p.svg') }}" alt="P"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
        <img src="{{ asset('client/assets/static/event-photo/hero-character-h.svg') }}" alt="H"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
        <img src="{{ asset('client/assets/static/event-photo/hero-character-o.svg') }}" alt="O"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
        <img src="{{ asset('client/assets/static/event-photo/hero-character-t-2.svg') }}" alt="T"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
        <img src="{{ asset('client/assets/static/event-photo/hero-character-o.svg') }}" alt="O"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
        <img src="{{ asset('client/assets/static/event-photo/hero-character-s.svg') }}" alt="S"
            class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">

    </div>

    <!-- ==========================================
         FOREGROUND LAYER (Nội dung hiển thị)
         ========================================== -->
    <!-- mt-[50px] lg:mt-[100px] để đẩy nội dung chữ nổi xuống giữa khung background SVG cho cân đối (có thể tùy chỉnh lại theo mắt nhìn) -->
    <div class="relative z-10 w-full px-4 flex flex-col items-center">

        <!-- Heading Chính: 48px, Bold(700), Line-height 22px -->
        <h1
            class="font-be-vietnam font-bold text-[32px] md:text-[40px] lg:text-[48px] text-black uppercase text-center break-words typing-effect">
            P4G Vietnam Summit
        </h1>

        <!-- Subtitle: 16px, Light(300), Line-height 22px -->
        <p
            class="font-be-vietnam font-light text-[14px] lg:text-[16px] text-black text-center leading-[22px] break-words" data-aos="fade-up" data-aos-delay="200">
            16th June 2019
        </p>

    </div>
</section>
