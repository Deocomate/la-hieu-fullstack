<section
    class="w-full bg-white pt-10 lg:pt-[40px] pb-[50px] md:pb-20 lg:pb-[100px] px-0 md:px-4 flex flex-col items-center overflow-hidden">
    <h2
        class="px-[30px] md:px-0 font-be-vietnam text-[18px] md:text-h-sub-24-wide font-extrabold tracking-[0.9px] md:tracking-[2.4px] text-black text-center uppercase typing-effect">
        {!! nl2br(e($page->content['partners']['title'] ?? "I don't walk this road alone\nMeet the partners who let me capture their journey")) !!}
    </h2>

    <div
        class="w-full max-w-[1320px] ml-[50px] mt-[50px] md:mt-[87px] flex flex-row md:grid overflow-x-auto md:overflow-visible snap-x snap-mandatory md:grid-cols-4 gap-[16px] md:gap-6 lg:gap-[52px] md:px-0 justify-items-center items-start [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

        @foreach ($partners as $index => $partner)
            @php
                $fallbackImage = 'client/assets/static/home/partner-' . (($index % 4) + 1) . '.png';
            @endphp
            <div class="w-[147px] md:w-full md:max-w-[295px] aspect-square flex-shrink-0 snap-start bg-transparent rounded-full overflow-hidden flex items-center justify-center cursor-pointer"
                data-aos="zoom-out" data-aos-delay="{{ ($index + 1) * 100 }}">
                @if ($partner->link_url)
                    <a href="{{ $partner->link_url }}" target="_blank" rel="noopener noreferrer"
                        class="w-full h-full block">
                        <img src="{{ \App\Support\ClientImage::url($partner->logo_image, $fallbackImage) }}"
                            alt="{{ $partner->name }}" class="w-full h-full object-cover" loading="lazy">
                    </a>
                @else
                    <img src="{{ \App\Support\ClientImage::url($partner->logo_image, $fallbackImage) }}"
                        alt="{{ $partner->name }}" class="w-full h-full object-cover" loading="lazy">
                @endif
            </div>
        @endforeach
    </div>
</section>
