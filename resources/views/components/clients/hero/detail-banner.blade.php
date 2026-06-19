@props([
    'title',
    'subtitle' => null,
    'bgText' => null,
])

<section
    class="relative w-full bg-white overflow-hidden pt-[33px] lg:pt-[80px] pb-[20px] lg:pb-[60px] flex flex-col items-center">
    @include('components.clients.hero.partials.bg-text', [
        'bgText' => $bgText,
        'title' => $title,
    ])

    <div class="relative z-10 w-full px-[35px] flex flex-col items-center">
        <h1
            class="font-be-vietnam text-[24px] md:text-hero-md font-extrabold tracking-[1.2px] md:tracking-normal text-black uppercase text-center break-words typing-effect">
            {{ $title }}
        </h1>

        @if ($subtitle)
            <p class="font-be-vietnam text-body-16-norm font-light md:mt-6 lg:mt-[5px] text-black text-center break-words"
                data-aos="fade-up" data-aos-delay="200">
                {{ $subtitle }}
            </p>

            <div class="w-[2px] h-[38px] bg-[#C5AA82] mt-[22px]" data-aos="fade-up" data-aos-delay="300"></div>
        @endif
    </div>
</section>
