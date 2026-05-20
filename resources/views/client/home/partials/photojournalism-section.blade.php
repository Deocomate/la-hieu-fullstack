<section class="relative w-full py-16 lg:pt-[188px] lg:pb-[92px] flex flex-col items-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('client/assets/static/home/photojournalism-background.png') }}"
            alt="Photojournalism Background" class="w-full h-full object-cover">
        <!-- Overlay Layers based on Figma design -->
        <!-- Layer 1: 20% Black overlay & Layer 2: Complex gradient from bottom to top -->
        <div class="absolute inset-0"
            style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.20) 0%, rgba(0, 0, 0, 0.20) 100%), linear-gradient(0deg, black 0%, rgba(19, 19, 19, 0.82) 40%, rgba(34, 34, 34, 0.66) 64%, rgba(102, 102, 102, 0) 100%);">
        </div>
    </div>

    <!-- Content Wrapper -->
    <div class="relative z-10 w-full px-4 flex flex-col items-center">

        <!-- Section Title -->
        <!-- Dùng text-heading (44px) và tracking-heading (4.4px) từ config -->
        <h2
            class="font-be-vietnam font-extrabold text-3xl lg:text-heading uppercase tracking-heading text-white text-center typing-effect">
            photojournalism
        </h2>

        <!-- Section Description -->
        <!-- Dùng text-desc (18px), tracking-desc (0.9px), max-width 767px và class text-shadow-image -->
        <p
            class="font-be-vietnam font-medium text-base lg:text-desc tracking-desc text-white text-center max-w-[767px] mt-6 lg:mt-[45px] text-shadow-image" data-aos="fade-up" data-aos-delay="200">
            Out in the field, there is no script. It is simply about stepping into different lives, listening quietly,
            and documenting their truths exactly as they unfold. Some days bring the quiet joy of a simple connection,
            while others carry the heavy weight of silent struggles. Yet, every moment is a humbling privilege to
            witness
        </p>

        <!-- Image Grid Container -->
        <!-- Max width 940px. Tính gap: Khoảng cách giữa left 522px và 330px(172px width) = 522 - (330+172) = 20px gap -->
        <div
            class="w-full max-w-[940px] mt-12 lg:mt-[104px] grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-[20px]">

            <!-- Image 1 -->
            <div class="w-full overflow-hidden shadow-lg group cursor-pointer" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('client/assets/static/home/photojournalism-image-1.png') }}" alt="Photojournalism 1"
                    class="w-full aspect-[172/258] object-cover transition-transform duration-500 group-hover:scale-105"
                    loading="lazy">
            </div>

            <!-- Image 2 -->
            <div class="w-full overflow-hidden shadow-lg group cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('client/assets/static/home/photojournalism-image-2.png') }}" alt="Photojournalism 2"
                    class="w-full aspect-[172/258] object-cover transition-transform duration-500 group-hover:scale-105"
                    loading="lazy">
            </div>

            <!-- Image 3 -->
            <div
                class="w-full overflow-hidden shadow-lg group cursor-pointer lg:col-span-1 sm:col-span-1 col-span-2 sm:col-auto" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('client/assets/static/home/photojournalism-image-3.png') }}" alt="Photojournalism 3"
                    class="w-full aspect-[172/258] sm:aspect-[172/258] aspect-video object-cover transition-transform duration-500 group-hover:scale-105"
                    loading="lazy">
            </div>

            <!-- Image 4 -->
            <div class="w-full overflow-hidden shadow-lg group cursor-pointer" data-aos="fade-up" data-aos-delay="400">
                <img src="{{ asset('client/assets/static/home/photojournalism-image-4.png') }}" alt="Photojournalism 4"
                    class="w-full aspect-[172/258] object-cover transition-transform duration-500 group-hover:scale-105"
                    loading="lazy">
            </div>

            <!-- Image 5 -->
            <div class="w-full overflow-hidden shadow-lg group cursor-pointer" data-aos="fade-up" data-aos-delay="500">
                <img src="{{ asset('client/assets/static/home/photojournalism-image-5.png') }}" alt="Photojournalism 5"
                    class="w-full aspect-[172/258] object-cover transition-transform duration-500 group-hover:scale-105"
                    loading="lazy">
            </div>

        </div>
    </div>
</section>
