<section class="w-full bg-white md:pt-12 lg:pt-[78px] pb-[50px] lg:pb-[100px] px-[29px] md:px-4 flex flex-col items-center">
    <!-- Main Container -->
    <!-- Desktop giới hạn chính xác tổng width: 372 (ảnh) + 38 (gap) + 327 (text) = 737px -->
    <div class="w-full max-w-[737px] flex flex-col md:flex-row gap-8 md:gap-[38px] items-start">

        <!-- Left Side: Image -->
        <!-- Rộng đúng 372px, cao 516px trên desktop -->
        @php
            $aboutImageSrc = \App\Support\ClientImage::url(
                $page->hero_images['about_image'] ?? null,
                'assets/static/about/about.png',
            );
        @endphp
        <div class="w-full md:w-[372px] flex-shrink-0" data-aos="zoom-out" data-aos-duration="1000">
            <img src="{{ $aboutImageSrc }}" alt="La Hieu Professional Photographer"
                class="w-full h-auto md:h-[516px] object-cover shadow-sm" loading="lazy">
        </div>

        <!-- Right Side: Content -->
        <!-- Rộng tối đa 327px trên desktop. Thụt xuống 32px so với đỉnh ảnh -->
        <div class="w-full md:max-w-[327px] flex flex-col md:mt-[32px]">

            <!-- Heading 1 -->
            <h1 class="font-be-vietnam text-h-hello font-semibold md:font-normal text-black typing-effect">
                {{ $page->hero_title ?? 'Hello,' }}
            </h1>

            <!-- Heading 2 -->
            <!-- Cách Heading 1 là 32px. Dùng text-h-sub-24-norm (24px) có sẵn trong config -->
            <h2
                class="font-be-vietnam text-h-sub-24-norm leading-[35px] font-normal text-black mt-6 md:mt-[32px] text-nowrap typing-effect">
                {!! nl2br(e($page->hero_subtitle ?? "I'm La Hieu,\na professional photographer\nbased in Hanoi.")) !!}
            </h2>

            <!-- Paragraph -->
            <!-- Cách Heading 2 là 38px. Dùng text-body-16-norm (16px, line-height 22px, weight 300/light) có sẵn trong config -->
            <p class="font-be-vietnam text-body-16-norm font-light text-black mt-6 md:mt-[38px]" data-aos="fade-up"
                data-aos-delay="200">
                {{ $page->hero_description ?? "Rooted in my love for backpacking, I am naturally drawn to authentic connections. What truly drives my lens is the people: I am constantly seeking those candid moments - the unguarded joy in a crowd, the quiet focus of someone hard at work, or the deep, unwritten stories etched into the faces of locals." }}
            </p>

            <!-- Signature Logo -->
            <!-- Cách Paragraph 30px. Kích thước chuẩn từ thiết kế ~101x50px -->
            @php
                $aboutSignatureSrc = \App\Support\ClientImage::url(
                    $page->hero_images['signature_logo'] ?? null,
                    'assets/static/about/logo.svg',
                );
            @endphp
            <div class="mt-8 md:mt-[30px]" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ $aboutSignatureSrc }}" alt="La Hieu Signature"
                    class="w-[101px] h-auto object-contain">
            </div>

        </div>
    </div>
</section>
