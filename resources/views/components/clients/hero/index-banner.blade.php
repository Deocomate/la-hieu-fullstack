@props([
    'title',
    'subtitle' => null,
    'description' => null,
    'bgText' => null,
])

<section
    class="relative w-full bg-white overflow-hidden pt-[35px] lg:pt-[80px] pb-[20px] lg:pb-[80px] flex flex-col items-center">
    @include('components.clients.hero.partials.bg-text', [
        'bgText' => $bgText,
        'title' => $title,
    ])

    <div class="relative z-10 w-full px-[35px] flex flex-col items-center">
        <h1
            class="font-be-vietnam text-[36px] md:text-hero-lg font-extrabold tracking-[1.8px] md:tracking-normal text-black uppercase text-center break-words typing-effect">
            {{ $title }}
        </h1>

        @if ($subtitle)
            <p class="font-be-vietnam text-body-16-norm font-thin mt-[5px] text-black text-center break-words"
                data-aos="fade-up" data-aos-delay="200">
                {{ $subtitle }}
            </p>
        @endif

        <div class="w-[2px] h-[38px] bg-[#C5AA82] mt-[22px]" data-aos="fade-up" data-aos-delay="300"></div>

        @if ($description)
            <p class="font-be-vietnam font-light text-[14px] text-black text-center leading-[22px] max-w-[430px] mt-[24px] mb-8 lg:mb-[47px]"
                data-aos="fade-up" data-aos-delay="400">
                {{ $description }}
            </p>
        @endif
    </div>
</section>
