<footer class="relative w-full md:min-h-[535px] flex flex-col lg:flex-row overflow-hidden">
    <!-- Ảnh Background (Hiển thị 100% width/height ở layer dưới cùng) -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('client/assets/static/footer/background.png') }}" alt="La Hieu Footer Background"
            class="w-full h-full object-cover object-center" loading="lazy">
    </div>

    <!-- Khung chia 50% bên trái (Chỉ hiển thị trên Desktop để lộ ảnh gốc) -->
    <div class="hidden lg:block lg:w-1/2 relative z-10"></div>

    <!-- Khung chia 50% bên phải (Chứa nội dung và Overlay bg-black/80 đè lên ảnh) -->
    <!-- Trên Mobile: Căn nội dung bắt đầu từ top (justify-start), áp dụng padding-top 41px và padding-bottom 76px -->
    <div
        class="w-full lg:w-1/2 relative z-10 bg-black/80 flex flex-col justify-start md:justify-center px-0 md:px-16 lg:px-[103px] pt-[41px] pb-[76px] md:py-12 md:min-h-[535px]">

        <!-- 1. Logo -->
        <!-- Mobile: Cách lề trái 31px, cách tên tác giả phía dưới 22px -->
        <a href="{{ url('/') }}" class="inline-block pl-[31px] md:pl-0 mb-[22px] md:mb-0" data-aos="fade-right">
            <img src="{{ asset('client/assets/static/footer/logo.svg') }}" alt="La Hieu Logo"
                class="w-[180px] md:w-[224px] h-auto object-contain">
        </a>

        <!-- 2. Tên tác giả -->
        <!-- Mobile: Cách lề trái 34px, cách tagline phía dưới 22px -->
        <h3
            class="font-be-vietnam text-[20px] md:text-h-sub-24-foot font-semibold tracking-[1px] md:tracking-[1.2px] text-white uppercase typing-effect pl-[34px] md:pl-0 mb-[22px] md:mb-0">
            Nguyễn Đức Hiếu
        </h3>

        <!-- 3. Quote / Tagline -->
        <!-- Mobile: Cách lề trái 34px, cách cụm contact phía dưới 41px -->
        <p
            class="font-be-vietnam text-[16px] md:text-h-sub-24-foot font-semibold italic tracking-[0.8px] md:tracking-[1.2px] text-white pl-[34px] md:pl-0 mt-0 md:mt-6 lg:mt-[45px] mb-[41px] md:mb-0 typing-effect">
            I'm always ready for the next journey<br />
            Let’s talk about yours
        </p>

        <!-- 4. Thông tin liên hệ -->
        <!-- Mobile: Thay đổi gap thành 0 và dùng margin riêng biệt cho từng hàng để khớp khoảng cách 22px -->
        <div class="flex flex-col gap-0 md:gap-4 mt-0 md:mt-8 lg:mt-[40px]" data-aos="fade-up" data-aos-delay="200">
            <!-- Số điện thoại -->
            <!-- Mobile: Cách lề trái 37px, khoảng cách icon đến chữ là 17px, cách email row phía dưới 22px -->
            <a href="tel:0902222876"
                class="flex items-center hover:opacity-80 transition-opacity w-max pl-[37px] md:pl-0 mb-[22px] md:mb-0">
                <img src="{{ asset('client/assets/static/footer/phone.svg') }}" alt="Phone Icon"
                    class="w-[20px] h-[20px] object-contain flex-shrink-0 md:mx-[50px]">
                <span
                    class="font-be-vietnam text-[16px] md:text-h-sub-24-foot font-normal tracking-[0.8px] md:tracking-[1.2px] text-white ml-[17px] md:ml-0">
                    090 2222 876
                </span>
            </a>

            <!-- Email -->
            <!-- Mobile: Cách lề trái 34px, kích thước icon 26px, khoảng cách icon đến chữ là 14px -->
            <a href="mailto:pvduchieu@gmail.com"
                class="flex items-center hover:opacity-80 transition-opacity w-max pl-[34px] md:pl-0">
                <img src="{{ asset('client/assets/static/footer/mail.svg') }}" alt="Mail Icon"
                    class="w-[26px] h-[20px] object-contain flex-shrink-0 md:mx-[47.5px]">
                <span
                    class="font-be-vietnam text-[16px] md:text-h-sub-24-foot font-normal tracking-[0.8px] md:tracking-[1.2px] text-white ml-[14px] md:ml-0">
                    pvduchieu@gmail.com
                </span>
            </a>
        </div>

    </div>
</footer>
