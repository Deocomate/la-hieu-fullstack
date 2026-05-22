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
        <a href="#" class="font-archivo text-paginate font-bold text-black border-b-[2.5px] border-black pb-[2px]">
            1
        </a>

        <!-- Inactive Page (2) -->
        <a href="#"
            class="font-archivo text-paginate font-bold text-black/40 hover:text-black transition-colors">
            2
        </a>

        <!-- Inactive Page (3) -->
        <a href="#"
            class="font-archivo text-paginate font-bold text-black/40 hover:text-black transition-colors">
            3
        </a>

        <!-- Dots (...) -->
        <!-- Letter-spacing 1.7px -->
        <span class="font-archivo text-paginate font-bold text-black/40 tracking-[1.7px]">
            ...
        </span>

        <!-- Inactive Page (9) -->
        <a href="#"
            class="font-archivo text-paginate font-bold text-black/40 hover:text-black transition-colors">
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
