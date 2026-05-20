<!-- resources/views/components/clients/pagination.blade.php -->
<nav class="flex items-center justify-center gap-[30px] lg:gap-[52px] w-full">

    <!-- Previous Button (40x40px) -->
    <a href="#"
        class="w-[40px] h-[40px] rounded-full border border-black/20 flex items-center justify-center hover:bg-gray-100 transition-colors cursor-pointer flex-shrink-0 group">
        <img src="{{ asset('client/assets/static/components/prev-buttom.svg') }}" alt="Previous"
            class="w-[40px] h-[40px] object-contain opacity-40 group-hover:opacity-100 transition-opacity">
    </a>

    <!-- Page Numbers Container (Gap 20px) -->
    <div class="flex items-center gap-[15px] lg:gap-[20px]">

        <!-- Active Page (1) -->
        <!-- Line-height 25.5px, border-bottom 2.5px solid black -->
        <a href="#" class="text-[17px] font-bold text-black leading-[25.5px] border-b-[2.5px] border-black pb-[2px]"
            style="font-family: 'Archivo', sans-serif;">
            1
        </a>

        <!-- Inactive Page (2) -->
        <a href="#"
            class="text-[17px] font-bold text-black/40 leading-[25.5px] hover:text-black transition-colors"
            style="font-family: 'Archivo', sans-serif;">
            2
        </a>

        <!-- Inactive Page (3) -->
        <a href="#"
            class="text-[17px] font-bold text-black/40 leading-[25.5px] hover:text-black transition-colors"
            style="font-family: 'Archivo', sans-serif;">
            3
        </a>

        <!-- Dots (...) -->
        <!-- Letter-spacing 1.7px -->
        <span class="text-[17px] font-bold text-black/40 leading-[25.5px] tracking-[1.7px]"
            style="font-family: 'Archivo', sans-serif;">
            ...
        </span>

        <!-- Inactive Page (9) -->
        <a href="#"
            class="text-[17px] font-bold text-black/40 leading-[25.5px] hover:text-black transition-colors"
            style="font-family: 'Archivo', sans-serif;">
            9
        </a>

    </div>

    <!-- Next Button (40x40px) -->
    <a href="#"
        class="w-[40px] h-[40px] rounded-full border border-black/20 flex items-center justify-center hover:bg-gray-100 transition-colors cursor-pointer flex-shrink-0 group">
        <img src="{{ asset('client/assets/static/components/next-buttom.svg') }}" alt="Next"
            class="w-[40px] h-[40px] object-contain opacity-40 group-hover:opacity-100 transition-opacity">
    </a>

</nav>
