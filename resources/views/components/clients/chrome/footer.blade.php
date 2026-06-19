@php
    $footerAuthor = $settings['footer_author_name'] ?? 'Nguyen Duc Hieu';
    $footerQuote = $settings['footer_quote'] ?? "I'm always ready for the next journey\nLet's talk about yours";
    $footerPhone = $settings['contact_phone'] ?? '090 2222 876';
    $footerEmail = $settings['contact_email'] ?? 'pvduchieu@gmail.com';
@endphp

<footer class="relative w-full md:min-h-[535px] flex flex-col lg:flex-row overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/static/footer/background.png') }}" alt="La Hieu Footer Background"
            class="w-full h-full object-cover object-center" loading="lazy">
    </div>

    <div class="hidden lg:block lg:w-1/2 relative z-10"></div>

    <div
        class="w-full lg:w-1/2 relative z-10 bg-black/80 flex flex-col justify-start md:justify-center px-0 md:px-16 lg:px-[103px] pt-[41px] pb-[76px] md:py-12 md:min-h-[535px]">

        <a href="{{ url('/') }}" class="inline-block pl-[31px] md:pl-0 mb-[22px] md:mb-0" data-aos="fade-right">
            <img src="{{ asset('assets/static/footer/logo.svg') }}" alt="La Hieu Logo"
                class="w-[180px] md:w-[224px] h-auto object-contain">
        </a>

        <h3
            class="font-be-vietnam text-[20px] md:text-h-sub-24-foot font-semibold tracking-[1px] md:tracking-[1.2px] text-white uppercase typing-effect pl-[34px] md:pl-0 mb-[22px] md:mb-0">
            {{ $footerAuthor }}
        </h3>

        <p
            class="font-be-vietnam text-[16px] md:text-h-sub-24-foot font-semibold italic tracking-[0.8px] md:tracking-[1.2px] text-white pl-[34px] md:pl-0 mt-0 md:mt-6 lg:mt-[45px] mb-[41px] md:mb-0 typing-effect">
            {!! nl2br(e($footerQuote)) !!}
        </p>

        <div class="flex flex-col gap-0 md:gap-4 mt-0 md:mt-8 lg:mt-[40px]" data-aos="fade-up" data-aos-delay="200">
            <a href="tel:{{ preg_replace('/\D+/', '', $footerPhone) }}"
                class="flex items-center hover:opacity-80 transition-opacity w-max pl-[37px] md:pl-0 mb-[22px] md:mb-0">
                <img src="{{ asset('assets/static/footer/phone.svg') }}" alt="Phone Icon"
                    class="w-[20px] h-[20px] object-contain flex-shrink-0 md:mx-[50px]">
                <span
                    class="font-be-vietnam text-[16px] md:text-h-sub-24-foot font-normal tracking-[0.8px] md:tracking-[1.2px] text-white ml-[17px] md:ml-0">
                    {{ $footerPhone }}
                </span>
            </a>

            <a href="mailto:{{ $footerEmail }}"
                class="flex items-center hover:opacity-80 transition-opacity w-max pl-[34px] md:pl-0">
                <img src="{{ asset('assets/static/footer/mail.svg') }}" alt="Mail Icon"
                    class="w-[26px] h-[20px] object-contain flex-shrink-0 md:mx-[47.5px]">
                <span
                    class="font-be-vietnam text-[16px] md:text-h-sub-24-foot font-normal tracking-[0.8px] md:tracking-[1.2px] text-white ml-[14px] md:ml-0">
                    {{ $footerEmail }}
                </span>
            </a>
        </div>

    </div>
</footer>
