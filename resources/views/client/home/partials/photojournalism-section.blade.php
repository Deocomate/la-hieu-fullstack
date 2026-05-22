<section
    class="relative w-full pt-[250px] pb-[90px] md:pt-16 md:pb-16 lg:pt-[188px] lg:pb-[92px] flex flex-col items-center overflow-hidden">

    <div class="absolute inset-0 z-0 hidden md:block">
        <img src="{{ asset('client/assets/static/home/photojournalism-background.png') }}"
            alt="Photojournalism Background" class="w-full h-full object-cover">
        <div class="absolute inset-0"
            style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.20) 0%, rgba(0, 0, 0, 0.20) 100%), linear-gradient(0deg, black 0%, rgba(19, 19, 19, 0.82) 40%, rgba(34, 34, 34, 0.66) 64%, rgba(102, 102, 102, 0) 100%);">
        </div>
    </div>

    <div class="absolute inset-0 z-0 md:hidden bg-black overflow-hidden">
        <img src="{{ asset('client/assets/static/home/photojournalism-background.png') }}"
            class="pj-bg-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-100"
            loading="lazy">

        @for ($i = 1; $i <= 5; $i++)
            <img src="{{ asset('client/assets/static/home/photojournalism-image-' . $i . '.png') }}"
                class="pj-bg-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0"
                loading="lazy">
        @endfor

        <div class="absolute inset-0 pointer-events-none"
            style="background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0) 35%, #000000 65%, #000000 100%);">
        </div>
    </div>

    <div class="absolute top-[18px] left-[18px] z-20 md:hidden cursor-pointer" id="pj-controller">
        <img src="{{ asset('client/assets/static/home/mobile-pause-button.svg') }}" id="pj-pause-icon" alt="Pause"
            class="w-[36px] h-[36px] object-contain">
        <img src="{{ asset('client/assets/static/home/mobile-play-button.svg') }}" id="pj-play-icon" alt="Play"
            class="w-[36px] h-[36px] object-contain hidden">
    </div>

    <div class="relative z-10 w-full px-[30px] md:px-4 flex flex-col items-center">
        <h2
            class="font-be-vietnam text-[24px] md:text-hero-sm font-extrabold tracking-[2.4px] md:tracking-[4.4px] uppercase text-white text-center typing-effect">
            photojournalism
        </h2>
        <p class="font-be-vietnam text-[14px] md:text-body-18-wide font-medium tracking-[0.14px] md:tracking-[0.9px] text-white text-center max-w-[767px] mt-[15px] md:mt-6 lg:mt-[45px] text-shadow-image"
            data-aos="fade-up" data-aos-delay="200">
            Out in the field, there is no script. It is simply about stepping into different lives, listening quietly,
            and documenting their truths exactly as they unfold. Some days bring the quiet joy of a simple connection,
            while others carry the heavy weight of silent struggles. Yet, every moment is a humbling privilege to
            witness
        </p>
    </div>

    @php
        // Cấu hình class đặc thù cho từng ảnh để đảm bảo layout hiển thị chính xác như bản gốc
        $galleryItems = [
            1 => ['wrapper' => '', 'img' => 'h-full aspect-[172/258]'],
            2 => ['wrapper' => '', 'img' => 'aspect-[172/258]'],
            3 => [
                'wrapper' => 'lg:col-span-1 sm:col-span-1 col-span-2 sm:col-auto',
                'img' => 'aspect-[172/258] sm:aspect-[172/258] aspect-video',
            ],
            4 => ['wrapper' => '', 'img' => 'aspect-[172/258]'],
            5 => ['wrapper' => '', 'img' => 'aspect-[172/258]'],
        ];
    @endphp

    <div
        class="relative z-10 w-full max-w-[940px] ml-[50px] md:ml-0 mt-[113px] md:mt-12 lg:mt-[104px] flex flex-row md:grid overflow-x-auto md:overflow-visible snap-x snap-mandatory md:grid-cols-2 lg:grid-cols-5 gap-[15px] md:gap-4 lg:gap-[20px] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
        @foreach ($galleryItems as $i => $classes)
            <div class="w-[240px] sm:w-[280px] md:w-full flex-shrink-0 snap-start overflow-hidden shadow-lg group cursor-pointer {{ $classes['wrapper'] }}"
                data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <img src="{{ asset('client/assets/static/home/photojournalism-image-' . $i . '.png') }}"
                    alt="Photojournalism {{ $i }}"
                    class="w-full h-full md:h-auto object-cover transition-transform duration-500 group-hover:scale-105 {{ $classes['img'] }}"
                    loading="lazy">
            </div>
        @endforeach
    </div>
</section>
