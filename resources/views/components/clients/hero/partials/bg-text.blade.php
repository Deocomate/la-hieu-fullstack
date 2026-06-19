@php
    $bgTextString = strtoupper($bgText ?? $title ?? '');
    $chars = mb_str_split($bgTextString);
    $bgSvgs = [];

    $specialCharsMap = [
        '?' => 'question',
        '!' => 'exclamation',
        '&' => 'ampersand',
        '#' => 'hash',
        '@' => 'at',
    ];

    foreach ($chars as $char) {
        if ($char === ' ') {
            $bgSvgs[] = ['is_spacer' => true];
        } else {
            $fileName = $specialCharsMap[$char] ?? strtolower($char);
            $bgSvgs[] = [
                'path' => asset("assets/static/hero-characters/hero-character-{$fileName}.svg"),
                'alt' => $char,
            ];
        }
    }
@endphp

<div
    class="absolute top-0 left-1/2 -translate-x-1/2 w-max flex items-center gap-[5px] lg:gap-[15px] z-0 pointer-events-none select-none opacity-80">
    @foreach ($bgSvgs as $svg)
        @if (isset($svg['is_spacer']) && $svg['is_spacer'])
            <div class="w-[20px] lg:w-[40px]"></div>
        @else
            <img src="{{ $svg['path'] }}" alt="{{ $svg['alt'] ?? 'BG' }}"
                class="h-[120px] md:h-[180px] lg:h-[221px] w-auto">
        @endif
    @endforeach
</div>
