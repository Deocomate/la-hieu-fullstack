<header class="w-full h-[56px] bg-white sticky top-0 z-50 shadow-sm" data-aos="fade-down">
    <!-- Container giới hạn 1200px và căn giữa -->
    <div class="max-w-[1200px] w-full h-full mx-auto px-4 xl:px-0 flex items-center justify-between">
        <!-- Logo bên trái -->
        <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center h-full hover:opacity-80 transition-opacity">
            <img src="{{ asset('client/assets/static/header/logo.svg') }}" alt="La Hieu Logo"
                class="h-[40px] w-auto object-contain">
        </a>
        
        <!-- Menu ở giữa -->
        <nav class="hidden lg:flex items-center gap-8 xl:gap-12">
            <a href="{{ url('about') }}"
                class="font-oswald text-nav uppercase tracking-nav transition-colors 
                {{ request()->is('about') ? 'text-gray-400 font-semibold' : 'text-black font-normal hover:text-gray-500' }}">
                About
            </a>
            
            <a href="{{ url('event-photos') }}"
                class="font-oswald text-nav uppercase tracking-nav transition-colors 
                {{ request()->is('event-photos*') ? 'text-gray-400 font-semibold' : 'text-black font-normal hover:text-gray-500' }}">
                Event Photo
            </a>
            
            <a href="{{ url('photojournalism') }}"
                class="font-oswald text-nav uppercase tracking-nav transition-colors 
                {{ request()->is('photojournalism*') ? 'text-gray-400 font-semibold' : 'text-black font-normal hover:text-gray-500' }}">
                Photojournalism
            </a>
            
            <!-- Lưu ý: Trong thư mục hiện tại của bạn phần videography chưa có index.blade.php, URL này đã được đặt sẵn chờ bạn tạo file -->
            <a href="{{ url('videography/detail') }}"
                class="font-oswald text-nav uppercase tracking-nav transition-colors 
                {{ request()->is('videography*') ? 'text-gray-400 font-semibold' : 'text-black font-normal hover:text-gray-500' }}">
                Videography
            </a>
            
            <a href="{{ url('faces-and-places') }}"
                class="font-oswald text-nav uppercase tracking-nav transition-colors 
                {{ request()->is('faces-and-places*') ? 'text-gray-400 font-semibold' : 'text-black font-normal hover:text-gray-500' }}">
                Faces & Places
            </a>
            
            <a href="{{ url('contact') }}"
                class="font-oswald text-nav uppercase tracking-nav transition-colors 
                {{ request()->is('contact') ? 'text-gray-400 font-semibold' : 'text-black font-normal hover:text-gray-500' }}">
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
