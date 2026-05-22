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
            'text' => 'Learn more about the project',
            'link_text' => 'here', // Tách riêng chữ "here" để tạo link
            'url' => '#',
        ],
    ];
@endphp

<section class="w-full bg-white px-[30px] md:px-4 pb-[50px] md:py-12 lg:pt-0 lg:pb-[50px] flex flex-col items-center">
    <!-- Container giới hạn chuẩn 700px theo thiết kế -->
    <div class="w-full max-w-[700px] flex flex-col">

        <!-- Render dữ liệu thông qua vòng lặp -->
        @foreach ($contentBlocks as $block)
            @switch($block['type'])
                @case('dropcap_paragraph')
                    <div class="w-full relative @if (!$loop->first) mt-[20px] md:mt-[47px] @endif"
                        data-aos="fade-up">
                        <p class="font-be-vietnam text-body-16-tall font-light text-black">
                            <!-- Chữ cái Dropcap: 78px, weight 400. Dùng float-left để text tự động bao quanh -->
                            <!-- Ghi đè leading thành 68px để float box có chiều cao bằng đúng 3 dòng text (~69px), căn chỉnh mt-[4px] khớp dòng kẻ đầu -->
                            <span
                                class="float-left font-be-vietnam text-[78px] leading-[50px] -mr-[4px] -translate-x-[6px] font-normal mt-[4px] text-black">
                                {{ $block['dropcap'] }}
                            </span>
                            {{ $block['text'] }}
                        </p>
                    </div>
                @break

                @case('heading')
                    <!-- Khoảng cách margin-top 47px theo design measure -->
                    <h2 class="font-be-vietnam font-extrabold text-[20px] md:text-[36px] tracking-[1.6px] md:tracking-normal leading-normal md:leading-normal uppercase text-black text-center mt-[20px] md:mt-[47px] break-words typing-effect"
                        data-aos="fade-up">
                        {{ $block['text'] }}
                    </h2>
                @break

                @case('paragraph')
                    <!-- Khoảng cách margin-top 50px theo design measure -->
                    <p class="font-be-vietnam text-body-16-tall font-light text-black mt-[20px] md:mt-[47px]" data-aos="fade-up">
                        {{ $block['text'] }}
                    </p>
                @break

                @case('link')
                    <!-- Khoảng cách margin-top 50px theo design measure -->
                    <div class="w-full flex justify-center mt-[20px] md:mt-[47px]" data-aos="fade-up">
                        <p class="font-be-vietnam text-body-16-tall font-normal text-black text-center">
                            {{ $block['text'] }}
                            @if (isset($block['link_text']))
                                <a href="{{ $block['url'] }}"
                                    class="text-[#0078B4] underline hover:opacity-70 transition-opacity">
                                    {{ $block['link_text'] }}
                                </a>
                            @endif
                        </p>
                    </div>
                @break
            @endswitch
        @endforeach

    </div>
</section>
