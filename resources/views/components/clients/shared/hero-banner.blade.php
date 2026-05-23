@php
    $finalTitle = $title ?? 'PHOTOJOURNALISM';
    $finalSubtitle = $subtitle ?? 'Unposed emotions. The true pulse of the event';
    $finalDescription = $description ?? null;
    $finalPaddingTop = $paddingTop ?? 'pt-[35px] lg:pt-[80px]';
    $finalPaddingBottom = $paddingBottom ?? 'pb-[20px] lg:pb-[80px]';
    $finalHeadingClass = $headingClass ?? 'text-[36px] md:text-hero-lg font-extrabold tracking-[1.8px] md:tracking-normal';
    $finalSubtitleClass = $subtitleClass ?? 'text-body-16-norm font-thin mt-[5px] lg:mt-[15px]';
    // Xử lý Dynamic Background Text
    $bgTextString = strtoupper($bgText ?? $title ?? 'PHOTOJOURNALISM');
    $chars = mb_str_split($bgTextString);
    $finalBgSvgs = [];
    
    // Mapping các ký tự đặc biệt trùng khớp với script JS tạo SVG
    $specialCharsMap = [
        '?' => 'question',
        '!' => 'exclamation',
        '&' => 'ampersand',
        '#' => 'hash',
        '@' => 'at'
    ];

    foreach ($chars as $char) {
        if ($char === ' ') {
            $finalBgSvgs[] = ['is_spacer' => true];
        } else {
            $fileName = $specialCharsMap[$char] ?? strtolower($char);
            $finalBgSvgs[] = [
                'path' => asset("client/assets/static/hero-characters/hero-character-{$fileName}.svg"),
                'alt' => $char
            ];
        }
    }
@endphp

<section
    class="relative w-full bg-white overflow-hidden {{ $finalPaddingTop }} {{ $finalPaddingBottom }} flex flex-col items-center">
    <div
        class="absolute top-[0px] lg:top-[0px] left-1/2 -translate-x-1/2 w-max flex items-center gap-[5px] lg:gap-[15px] z-0 pointer-events-none select-none opacity-80">
        @foreach ($finalBgSvgs as $svg)
            @if (isset($svg['is_spacer']) && $svg['is_spacer'])
                <div class="w-[20px] lg:w-[40px]"></div>
            @else
                <img src="{{ $svg['path'] }}" alt="{{ $svg['alt'] ?? 'BG' }}"
                    class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
            @endif
        @endforeach
    </div>

    <div class="relative z-10 w-full px-[35px] flex flex-col items-center">
        <h1
            class="font-be-vietnam {{ $finalHeadingClass }} text-black uppercase text-center break-words typing-effect">
            {{ $finalTitle }}
        </h1>

        <p class="font-be-vietnam {{ $finalSubtitleClass }} text-black text-center break-words" data-aos="fade-up"
            data-aos-delay="200">
            {{ $finalSubtitle }}
        </p>

        <div class="w-[2px] h-[38px] bg-[#C5AA82] mt-[22px]" data-aos="fade-up" data-aos-delay="300"></div>

        @if ($finalDescription !== null)
            <p class="font-be-vietnam font-light text-[14px] text-black text-center leading-[22px] max-w-[430px] mt-[24.43px] mb-8 lg:mb-[47px]"
                data-aos="fade-up" data-aos-delay="400">
                {{ $finalDescription }}
            </p>
        @endif
    </div>
</section>
