{{-- resources/views/client/photojournalism/partials/detail-content-section.blade.php --}}

@php
    // Mô phỏng dữ liệu dạng Block Content trả về từ Backend/Database
    $contentBlocks = [
        [
            'type' => 'dropcap_paragraph',
            'dropcap' => 'E',
            'text' =>
                'ven in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event. Even in the middle of a vibrant crowd, I am always looking for the same thing.Increasingly, in the smartphone market, barring a radical change in trend, that’s Android until some will argue that the third quarter was a fluke, another point is that because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick.',
        ],
        [
            'type' => 'heading',
            'text' => 'google will change thE field',
        ],
        [
            'type' => 'paragraph',
            'text' =>
                'Because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick on the contrary Apple is likely to respond with a calculated price cut for instance Apple’s sales have peaked, until Android’s already working on a rival to Siri’s digital assistant, at the end some will argue that the third quarter was a fluke, due to it seems to me that innovation is beginning to run dry,and the stock price is overinflated especially Apple stores will have to sacrifice some selling space of other gadgets moreover the stock has begun to fall already dropping from its $426 high.',
        ],
        [
            'type' => 'paragraph',
            'text' =>
                'But my sell signal stands, and I wanted to offer rational and objective clarity for that call, at last consumers were disappointed that it wasn‘t the iPhone 5 during Apple stores will have to sacrifice some selling space of other gadgets first but my sell signal stands, and I wanted to offer rational and objective clarity for that call, before there’s too much cash snoozing on Apple’s balance sheet, what some will argue that the third quarter was a fluke.',
        ],
        [
            'type' => 'link',
            'text' => 'Learn more about the project here',
            'url' => '#',
        ],
    ];
@endphp

<section class="w-full bg-white px-4 py-12 lg:pt-0 lg:pb-[50px] flex flex-col items-center">
    <!-- Container giới hạn chuẩn 700px theo thiết kế -->
    <div class="w-full max-w-[700px] flex flex-col">

        <!-- Render dữ liệu thông qua vòng lặp -->
        @foreach ($contentBlocks as $block)
            @switch($block['type'])
                @case('dropcap_paragraph')
                    <div class="w-full relative @if (!$loop->first) mt-[50px] @endif" data-aos="fade-up">
                        <p class="font-be-vietnam font-light text-[16px] leading-[23px] text-black">
                            <!-- Chữ cái Dropcap: 78px, weight 400. Dùng float-left để text tự động bao quanh -->
                            <span
                                class="float-left font-be-vietnam font-normal text-[78px] leading-[60px] pt-[6px] pr-[10px] text-black">
                                {{ $block['dropcap'] }}
                            </span>
                            {{ $block['text'] }}
                        </p>
                    </div>
                @break

                @case('heading')
                    <!-- Khoảng cách margin-top 47px theo design measure -->
                    <h2
                        class="font-be-vietnam font-extrabold text-[28px] md:text-[36px] uppercase text-black text-center mt-[47px] break-words typing-effect" data-aos="fade-up">
                        {{ $block['text'] }}
                    </h2>
                @break

                @case('paragraph')
                    <!-- Khoảng cách margin-top 50px theo design measure -->
                    <p class="font-be-vietnam font-light text-[16px] leading-[23px] text-black mt-[50px]" data-aos="fade-up">
                        {{ $block['text'] }}
                    </p>
                @break

                @case('link')
                    <!-- Khoảng cách margin-top 50px theo design measure -->
                    <div class="w-full flex justify-center mt-[50px]" data-aos="fade-up">
                        <a href="{{ $block['url'] }}"
                            class="font-be-vietnam font-normal text-[16px] leading-[23px] text-black text-center hover:text-gray-500 transition-colors hover:underline">
                            {{ $block['text'] }}
                        </a>
                    </div>
                @break
            @endswitch
        @endforeach

    </div>
</section>
