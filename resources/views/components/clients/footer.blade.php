<footer class="relative w-full min-h-[535px] flex flex-col lg:flex-row overflow-hidden">
    <!-- Ảnh Background (Hiển thị 100% width/height ở layer dưới cùng) -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('client/assets/static/footer/background.png') }}" alt="La Hieu Footer Background"
            class="w-full h-full object-cover object-center" loading="lazy">
    </div>

    <!-- Khung chia 50% bên trái (Chỉ hiển thị trên Desktop để lộ ảnh gốc) -->
    <div class="hidden lg:block lg:w-1/2 relative z-10"></div>

    <!-- Khung chia 50% bên phải (Chứa nội dung và Overlay bg-black/80 đè lên ảnh) -->
    <!-- Trên Mobile/Tablet (<1024px) sẽ chiếm 100% width để chữ luôn dễ đọc -->
    <div
        class="w-full lg:w-1/2 relative z-10 bg-black/80 flex flex-col justify-center px-6 py-12 md:px-16 lg:px-[103px] min-h-[535px]">

        <!-- 1. Logo -->
        <a href="{{ url('/') }}" class="inline-block" data-aos="fade-right">
            <img src="{{ asset('client/assets/static/footer/logo.svg') }}" alt="La Hieu Logo"
                class="w-[180px] md:w-[224px] h-auto object-contain">
        </a>

        <!-- 2. Tên tác giả -->
        <!-- font-size: 24px, weight: 600 (semibold), uppercase, tracking: 1.2px -->
        <h3 class="font-be-vietnam font-semibold text-[20px] md:text-[24px] text-white uppercase tracking-[1.2px] typing-effect">
            Nguyễn Đức Hiếu
        </h3>

        <!-- 3. Quote -->
        <!-- font-size: 24px, weight: 600, italic, tracking: 1.2px -->
        <p
            class="font-be-vietnam font-semibold italic text-[20px] md:text-[24px] text-white tracking-[1.2px] mt-6 lg:mt-[45px] leading-snug typing-effect">
            I'm always ready for the next journey<br class="hidden sm:block" />
            Let’s talk about yours
        </p>

        <!-- 4. Thông tin liên hệ -->
        <div class="flex flex-col gap-4 mt-8 lg:mt-[40px]" data-aos="fade-up" data-aos-delay="200">
            <!-- Số điện thoại -->
            <a href="tel:0902222876" class="flex items-center gap-4 hover:opacity-80 transition-opacity w-max">
                <img src="{{ asset('client/assets/static/footer/phone.svg') }}" alt="Phone Icon"
                    class="w-[20px] h-[20px] object-contain flex-shrink-0 md:mx-[50px]">
                <span class="font-be-vietnam font-normal text-[20px] md:text-[24px] text-white tracking-[1.2px]">
                    090 2222 876
                </span>
            </a>

            <!-- Email -->
            <a href="mailto:pvduchieu@gmail.com"
                class="flex items-center gap-4 hover:opacity-80 transition-opacity w-max">
                <img src="{{ asset('client/assets/static/footer/mail.svg') }}" alt="Mail Icon"
                    class="w-[26px] h-[20px] object-contain flex-shrink-0 md:mx-[47.5px]">
                <span class="font-be-vietnam font-normal text-[20px] md:text-[24px] text-white tracking-[1.2px]">
                    pvduchieu@gmail.com
                </span>
            </a>
        </div>

    </div>
</footer>
