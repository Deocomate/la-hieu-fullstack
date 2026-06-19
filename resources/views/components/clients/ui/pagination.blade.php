@if ($paginator->hasPages())
    <nav class="flex items-center justify-center gap-[30px] lg:gap-[52px] w-full" role="navigation"
        aria-label="Pagination Navigation">

        @if ($paginator->onFirstPage())
            <span
                class="w-[40px] h-[40px] rounded-full border border-black/10 flex items-center justify-center flex-shrink-0 opacity-30">
                <img src="{{ asset('client/assets/static/components/prev-buttom.svg') }}" alt="Previous"
                    class="w-[40px] h-[40px] object-contain">
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="w-[40px] h-[40px] rounded-full border border-black/20 flex items-center justify-center hover:bg-gray-100 transition-colors cursor-pointer flex-shrink-0 group">
                <img src="{{ asset('client/assets/static/components/prev-buttom.svg') }}" alt="Previous"
                    class="w-[40px] h-[40px] object-contain opacity-40 group-hover:opacity-100 transition-opacity">
            </a>
        @endif

        <div class="flex items-center gap-[15px] lg:gap-[20px]">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="font-archivo text-paginate font-bold text-black/40 tracking-[1.7px]">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="font-archivo text-paginate font-bold text-black border-b-[2.5px] border-black pb-[2px]"
                                aria-current="page">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="font-archivo text-paginate font-bold text-black/40 hover:text-black transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="w-[40px] h-[40px] rounded-full border border-black/20 flex items-center justify-center hover:bg-gray-100 transition-colors cursor-pointer flex-shrink-0 group">
                <img src="{{ asset('client/assets/static/components/next-buttom.svg') }}" alt="Next"
                    class="w-[40px] h-[40px] object-contain opacity-40 group-hover:opacity-100 transition-opacity">
            </a>
        @else
            <span
                class="w-[40px] h-[40px] rounded-full border border-black/10 flex items-center justify-center flex-shrink-0 opacity-30">
                <img src="{{ asset('client/assets/static/components/next-buttom.svg') }}" alt="Next"
                    class="w-[40px] h-[40px] object-contain">
            </span>
        @endif
    </nav>
@endif
