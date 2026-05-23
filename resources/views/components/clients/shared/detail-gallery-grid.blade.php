@php
    $defaultImages = [
        asset('client/assets/static/event-photo/gallery-grid-1.png'),
        asset('client/assets/static/event-photo/gallery-grid-2.png'),
        asset('client/assets/static/event-photo/gallery-grid-3.png'),
        asset('client/assets/static/event-photo/gallery-grid-4.png'),
        asset('client/assets/static/event-photo/gallery-grid-5.png'),
        asset('client/assets/static/event-photo/gallery-grid-6.png'),
        asset('client/assets/static/event-photo/gallery-grid-7.png'),
        asset('client/assets/static/event-photo/gallery-grid-8.png'),
    ];
    $gridImages = $images ?? $defaultImages;
@endphp

<section class="w-full bg-white px-[30px] md:px-[25px] pb-[50px] md:py-[50px]">
    <div class="lg:hidden w-full columns-2 gap-[10px]" data-aos="fade-up">
        @foreach ($gridImages as $index => $image)
            <div class="w-full mb-[10px] break-inside-avoid overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ $image }}" alt="Gallery Grid Image {{ $index + 1 }}"
                    class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
        @endforeach
    </div>

    <div class="hidden lg:flex lg:flex-col lg:gap-[15px] w-full">
        <div class="flex flex-nowrap gap-[15px] w-full h-[340px]" data-aos="fade-up">
            <div class="w-auto [flex:500] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ $gridImages[0] }}" alt="Gallery Image 1"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <div class="w-auto [flex:242] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ $gridImages[1] }}" alt="Gallery Image 2"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <div class="w-auto [flex:497] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ $gridImages[2] }}" alt="Gallery Image 3"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <div class="w-auto [flex:242] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ $gridImages[3] }}" alt="Gallery Image 4"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
        </div>

        <div class="flex flex-nowrap gap-[15px] w-full h-[340px]" data-aos="fade-up" data-aos-delay="150">
            <div class="w-auto [flex:218] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ $gridImages[4] }}" alt="Gallery Image 5"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <div class="w-auto [flex:502] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ $gridImages[5] }}" alt="Gallery Image 6"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <div class="w-auto [flex:183] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ $gridImages[6] }}" alt="Gallery Image 7"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>

            <div class="w-auto [flex:497] h-full overflow-hidden group relative cursor-pointer shadow-sm">
                <img src="{{ $gridImages[7] }}" alt="Gallery Image 8"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
        </div>
    </div>
</section>
