<section class="w-full bg-white relative pb-[80.39px] md:pb-16 lg:pb-24">
    <!-- Image Section -->
    <!-- Desktop: padding left/right 27px, padding bottom 96px.
         Mobile: Full width (px-0), chiều cao ảnh 345px, padding bottom 25px (để tạo khoảng cách đến Title) -->
    <div class="w-full px-0 md:px-4 xl:px-[27px] pb-[25px] md:pb-10 lg:pb-[96px]" data-aos="zoom-out"
        data-aos-duration="1200">
        @php
            $heroBannerSrc = \App\Support\ClientImage::url(
                $page->hero_images['hero_banner'] ?? null,
                'assets/static/home/hero-image.png',
            );
            $signatureLogoSrc = \App\Support\ClientImage::url(
                $page->hero_images['signature_logo'] ?? null,
                'assets/static/home/hero-logo.svg',
            );
        @endphp
        <img src="{{ $heroBannerSrc }}" alt="La Hieu Photography - Hmong Girl"
            class="w-full h-[345px] md:h-auto object-cover" loading="lazy">

        <!-- Mobile: Line cao 25px, màu #CDB88D. Desktop: cao 38px, màu #C5AA82 -->
        <div class="w-[2px] h-[25px] md:h-[38px] bg-[#CDB88D] md:bg-[#C5AA82] mx-auto" data-aos="fade-up"
            data-aos-delay="300">
        </div>
    </div>

    <!-- Content Section -->
    <!-- Mobile: Padding 2 bên 30px theo design. Desktop: Padding 16px (px-4) -->
    <div class="w-full flex flex-col items-center justify-center px-[30px] md:px-4">

        <!-- Title: 24px, weight 400, line-height 25px -->
        <h1 class="font-be-vietnam text-h-sub-24-norm font-normal text-black text-center text-wrap typing-effect">
            {!! nl2br(e($page->hero_title ?? "Welcome to La Hieu Photography website!")) !!}
        </h1>

        <!-- Description: 16px, weight 300, line-height 22px, max-width 608px -->
        <!-- Mobile: Cách title 41px. Desktop: Cách 28px -->
        <p class="font-be-vietnam text-[14px] md:text-body-16-norm leading-[22px] font-light text-black text-center max-w-[608px] mt-[41px] md:mt-[28px]"
            data-aos="fade-up" data-aos-delay="300">
            {{ $page->hero_description ?? "Step into the journey I have been on. It all started back in 2009, chasing wild, untouched landscapes with nothing but a bike, a backpack, and a camera. Somewhere along those dusty roads, my passion quietly became my life's work. Today, whether I'm in the middle of vibrant events or out on the field trips, my heart belongs to raw human stories captured through both lens and motion. Connecting with different lives, telling their truths. I am truly living my dream." }}
        </p>

        <!-- Signature Logo -->
        <!-- Mobile: Cách đoạn text trên 24px. Desktop: Cách 32px -->
        <div class="mt-[24px] md:mt-[32px] flex justify-center" data-aos="fade-up" data-aos-delay="500">
            <img src="{{ $signatureLogoSrc }}" alt="La Hieu Signature" class="w-[101px] h-auto object-contain">
        </div>

    </div>
</section>
