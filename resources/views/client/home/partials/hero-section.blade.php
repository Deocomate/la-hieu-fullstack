<section class="w-full bg-white relative pb-16 lg:pb-24">
    <!-- Image Section -->
    <!-- Desktop: padding left/right 27px, padding bottom 96px. Mobile: padding 16px (px-4) -->
    <div class="w-full px-4 xl:px-[27px] pb-10 lg:pb-[96px]" data-aos="zoom-out" data-aos-duration="1200">
        <img src="{{ asset('client/assets/static/home/hero-image.png') }}" alt="La Hieu Photography - Hmong Girl"
            class="w-full h-auto object-cover" loading="lazy">
    </div>

    <!-- Content Section -->
    <div class="w-full flex flex-col items-center justify-center px-4">

        <!-- Title: 24px, weight 400, line-height 25px -->
        <!-- Đã sử dụng text-title (24px/25px) và font-be-vietnam từ tailwind config -->
        <h1 class="font-be-vietnam font-normal text-title text-black text-center text-wrap typing-effect">
            Welcome to La Hieu Photography website!
        </h1>

        <!-- Description: 16px, weight 300, line-height 22px, max-width 608px -->
        <!-- Đã sử dụng text-body (16px/22px) từ tailwind config, mt-[28px] được tính từ khoảng cách top 835px - 807px(bottom of title) -->
        <p class="font-be-vietnam font-light text-body text-black text-center max-w-[608px] mt-5 lg:mt-[28px]" data-aos="fade-up" data-aos-delay="300">
            Step into the journey I have been on. It all started back in 2009, chasing wild,
            untouched landscapes with nothing but a bike, a backpack, and a camera.
            Somewhere along those dusty roads, my passion quietly became my life's work.
            Today, whether I’m in the middle of vibrant events or out on the field trips, my
            heart belongs to raw human stories captured through both lens and motion.
            Connecting with different lives, telling their truths. I am truly living my dream.
        </p>

        <!-- Signature Logo -->
        <!-- mt-[32px] tạo không gian thở hợp lý giữa đoạn text và logo -->
        <div class="mt-8 lg:mt-[32px] flex justify-center" data-aos="fade-up" data-aos-delay="500">
            <img src="{{ asset('client/assets/static/home/hero-logo.svg') }}" alt="La Hieu Signature"
                class="w-[101px] h-auto object-contain">
        </div>

    </div>
</section>
