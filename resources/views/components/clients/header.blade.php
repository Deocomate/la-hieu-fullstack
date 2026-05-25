<header class="w-full h-[56px] bg-white sticky top-0 z-50 shadow-sm" data-aos="fade-down">
    <!-- ==========================================
         MOBILE HEADER (< md)
         ========================================== -->
    <!-- Sử dụng pl-[31px] và pr-[34px] theo chính xác file design context -->
    <div class="md:hidden w-full h-full flex items-center pl-[31px] pr-[34px] relative">
        <!-- Hamburger Menu (Trái) -->
        <button id="mobile-menu-open" class="flex-shrink-0 hover:opacity-70 transition-opacity">
            <img src="{{ asset('client/assets/static/header/mobile-hamburger-menu-icon.svg') }}" alt="Menu"
                class="w-auto h-auto">
        </button>

        <!-- Logo (Giữa) -->
        <!-- Căn giữa tuyệt đối so với toàn bộ thanh navigation -->
        <a href="{{ url('/') }}"
            class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-[40px] hover:opacity-80 transition-opacity">
            <img src="{{ asset('client/assets/static/header/logo.svg') }}" alt="La Hieu Logo"
                class="h-full w-auto object-contain">
        </a>

        <!-- Search Icon (Phải) -->
        <!-- Đẩy về sát góc phải bằng ml-auto -->
        <button class="ml-auto flex-shrink-0 flex items-center justify-center hover:opacity-70 transition-opacity">
            <img src="{{ asset('client/assets/static/header/search.svg') }}" alt="Search"
                class="w-[18px] h-[18px] object-contain">
        </button>
    </div>

    <!-- ==========================================
         DESKTOP HEADER (>= md)
         ========================================== -->
    <!-- Bọc trong hidden md:flex để không ảnh hưởng layout di động và giữ nguyên cấu trúc trước đây -->
    <div class="hidden md:flex max-w-[1200px] w-full h-full mx-auto px-4 xl:px-0 items-center justify-between">
        <!-- Logo bên trái -->
        <a href="{{ url('/') }}"
            class="flex-shrink-0 flex items-center h-full hover:opacity-80 transition-opacity">
            <img src="{{ asset('client/assets/static/header/logo.svg') }}" alt="La Hieu Logo"
                class="h-[40px] w-auto object-contain">
        </a>
        <!-- Menu ở giữa -->
        <nav class="hidden lg:flex items-center gap-8 xl:gap-12">
            <a href="{{ url('about') }}"
                class="font-oswald text-[18px] md:text-nav uppercase tracking-[1.8px] md:tracking-[1.2px] transition-colors
                {{ request()->is('about') ? 'text-gray-400 font-medium md:font-semibold' : 'text-black font-medium md:font-normal hover:text-gray-500' }}">
                About
            </a>
            <a href="{{ url('event-photos') }}"
                class="font-oswald text-[18px] md:text-nav uppercase tracking-[1.8px] md:tracking-[1.2px] transition-colors
                {{ request()->is('event-photos*') ? 'text-gray-400 font-medium md:font-semibold' : 'text-black font-medium md:font-normal hover:text-gray-500' }}">
                Event Photo
            </a>
            <a href="{{ url('photojournalism') }}"
                class="font-oswald text-[18px] md:text-nav uppercase tracking-[1.8px] md:tracking-[1.2px] transition-colors
                {{ request()->is('photojournalism*') ? 'text-gray-400 font-medium md:font-semibold' : 'text-black font-medium md:font-normal hover:text-gray-500' }}">
                Photojournalism
            </a>
            <!-- Lưu ý: Trong thư mục hiện tại của bạn phần videography chưa có index.blade.php, URL này đã được đặt sẵn chờ bạn tạo file -->
            <a href="{{ route('videography.index') }}"
                class="font-oswald text-[18px] md:text-nav uppercase tracking-[1.8px] md:tracking-[1.2px] transition-colors
                {{ request()->is('videography*') ? 'text-gray-400 font-medium md:font-semibold' : 'text-black font-medium md:font-normal hover:text-gray-500' }}">
                Videography
            </a>
            <a href="{{ url('faces-and-places') }}"
                class="font-oswald text-[18px] md:text-nav uppercase tracking-[1.8px] md:tracking-[1.2px] transition-colors
                {{ request()->is('faces-and-places*') ? 'text-gray-400 font-medium md:font-semibold' : 'text-black font-medium md:font-normal hover:text-gray-500' }}">
                Faces & Places
            </a>
            <a href="{{ url('contact') }}"
                class="font-oswald text-[18px] md:text-nav uppercase tracking-[1.8px] md:tracking-[1.2px] transition-colors
                {{ request()->is('contact') ? 'text-gray-400 font-medium md:font-semibold' : 'text-black font-medium md:font-normal hover:text-gray-500' }}">
                Contact
            </a>
        </nav>
        <!-- Icon Search bên phải -->
        <button class="flex-shrink-0 flex items-center justify-center p-2 hover:opacity-70 transition-opacity">
            <img src="{{ asset('client/assets/static/header/search.svg') }}" alt="Search"
                class="w-[18px] h-[18px] object-contain">
        </button>
    </div>
</header>

<!-- ==========================================
     FULL-SCREEN MOBILE MENU OVERLAY (< md)
     ========================================== -->
<div id="mobile-menu-overlay"
    class="fixed inset-0 bg-white z-[60] flex flex-col overflow-y-auto transition-transform duration-300 translate-x-full md:hidden">
    <!-- Close Button Wrapper (Top Center) -->
    <!-- Khoảng cách từ lề trên đến icon: 26.63px, margin-bottom 50px -->
    <div class="w-full relative flex justify-center mt-[26.63px] mb-[50px]">
        <button id="mobile-menu-close" class="hover:opacity-70 transition-opacity p-2">
            <img src="{{ asset('client/assets/static/header/mobile-close-icon.svg') }}" alt="Close"
                class="w-auto h-auto">
        </button>
    </div>

    <!-- Navigation Links -->
    <!-- Cách lề trái 30px, khoảng cách dọc giữa các mục 38px -->
    <nav class="flex flex-col pl-[30px] gap-[38px]">
        <a href="{{ url('about') }}"
            class="font-oswald text-[18px] text-[#222222] uppercase tracking-[1.8px] leading-[18px] font-medium break-words w-max {{ request()->is('about') ? 'underline' : 'hover:opacity-70' }}">ABOUT</a>
        <a href="{{ url('event-photos') }}"
            class="font-oswald text-[18px] text-[#222222] uppercase tracking-[1.8px] leading-[18px] font-medium break-words w-max {{ request()->is('event-photos*') ? 'underline' : 'hover:opacity-70' }}">EVENT
            PHOTOS</a>
        <a href="{{ url('photojournalism') }}"
            class="font-oswald text-[18px] text-[#222222] uppercase tracking-[1.8px] leading-[18px] font-medium break-words w-max {{ request()->is('photojournalism*') ? 'underline' : 'hover:opacity-70' }}">PHOTOJOURNALISM</a>
        <a href="{{ route('videography.index') }}"
            class="font-oswald text-[18px] text-[#222222] uppercase tracking-[1.8px] leading-[18px] font-medium break-words w-max {{ request()->is('videography*') ? 'underline' : 'hover:opacity-70' }}">VIDEOGRAPHY</a>
        <a href="{{ url('faces-and-places') }}"
            class="font-oswald text-[18px] text-[#222222] uppercase tracking-[1.8px] leading-[18px] font-medium break-words w-max {{ request()->is('faces-and-places*') ? 'underline' : 'hover:opacity-70' }}">FACES
            & PLACES</a>
        <a href="{{ url('contact') }}"
            class="font-oswald text-[18px] text-[#222222] uppercase tracking-[1.8px] leading-[18px] font-medium break-words w-max {{ request()->is('contact') ? 'underline' : 'hover:opacity-70' }}">CONTACT</a>
    </nav>

    <!-- Background Logo -->
    <!-- Khoảng cách dọc từ mục menu cuối cùng đến đỉnh logo là 159px. Mờ như watermark (opacity thấp) -->
    <div class="w-full flex justify-center mt-[159px] pb-[50px] opacity-[0.05] pointer-events-none">
        <img src="{{ asset('client/assets/static/header/logo.svg') }}" alt="Watermark"
            class="w-[200px] sm:w-[250px] h-auto object-contain">
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuOpenBtn = document.getElementById('mobile-menu-open');
            const menuCloseBtn = document.getElementById('mobile-menu-close');
            const menuOverlay = document.getElementById('mobile-menu-overlay');

            if (menuOpenBtn && menuCloseBtn && menuOverlay) {
                // Mở menu
                menuOpenBtn.addEventListener('click', function() {
                    menuOverlay.classList.remove('translate-x-full');
                    menuOverlay.classList.add('translate-x-0');
                    document.body.style.overflow = 'hidden'; // Ngăn cuộn background body
                });

                // Đóng menu
                menuCloseBtn.addEventListener('click', function() {
                    menuOverlay.classList.remove('translate-x-0');
                    menuOverlay.classList.add('translate-x-full');
                    document.body.style.overflow = ''; // Phục hồi cuộn
                });
            }
        });
    </script>
@endpush
