@props([
    'bgColor' => 'transparent', // Nhận mã màu, ví dụ: '#FAFAFA' hoặc 'transparent'
    'isSwapped' => false, // true: Logo bên trái, Ảnh & Text bên phải trên Desktop
    'image' => asset('client/assets/static/photojournalism/photo-image-card-1.png'),
    'logo' => asset('client/assets/static/photojournalism/photo-logo-card-1.svg'),
    'category' => 'Uncategorized',
    'title' => 'Mordern & Trendy App Designs',
    'description' =>
        'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event. Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character.',
    'date' => 'August 6, 2020',
])

<!-- ==========================================
     MOBILE LAYOUT (< md)
     ========================================== -->
<div class="md:hidden w-full flex flex-col pb-[21.87px]" style="background-color: {{ $bgColor }}" data-aos="fade-up">

    <!-- Top Media Row (Chiều cao tương đối của khu vực ảnh, căn lề và hoán đổi vị trí khi isSwapped = true) -->
    <div
        class="w-full flex items-center pt-[20px] {{ $isSwapped ? 'flex-row-reverse pl-[36.57px] pr-[29px]' : 'flex-row pl-[29px] pr-[36.57px]' }}">

        <!-- Image Thumbnail (Media chính) -->
        <div class="flex-1 aspect-square overflow-hidden shadow-sm bg-gray-100" data-aos="zoom-out"
            data-aos-duration="1000">
            <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover" loading="lazy">
        </div>

        <!-- Khoảng cách giữa ảnh và avatar: 37.74px -->
        <div class="w-[37.74px] shrink-0"></div>

        <!-- Avatar/Icon Container (Tròn, màu xanh primary, kích thước 94.69px) -->
        <div class="w-[94.69px] h-[94.69px] rounded-full md:bg-primary flex items-center justify-center shrink-0 shadow-sm"
            data-aos="fade-up" data-aos-delay="250">
            <img src="{{ $logo }}" alt="Logo" class="w-full h-full object-contain" loading="lazy">
        </div>
    </div>

    <!-- Content Block bên dưới ảnh (Khoảng cách từ ảnh xuống text: 20.13px) -->
    <div class="w-full flex flex-col mt-[20.13px] {{ $isSwapped ? 'items-end text-right pr-[29px] pl-4' : 'items-start text-left pl-[29px] pr-4' }}"
        data-aos="fade-up" data-aos-delay="150">

        <!-- Category Label -->
        <span class="font-be-vietnam font-light text-[14px] leading-[22px] text-black">
            {{ $category }}
        </span>

        <!-- Title -->
        <h3 class="font-be-vietnam font-semibold text-[18px] leading-[22px] text-black mt-1">
            {{ $title }}
        </h3>

        <!-- Accent Divider (Cách title 15px, dày 5px) -->
        <div class="w-[40px] h-[5px] bg-[#C5AA82] mt-[15px]"></div>

        <!-- Description Block -->
        <p class="font-be-vietnam font-light text-[14px] leading-[22px] text-black mt-4">
            {{ $description }}
        </p>

        <!-- Date Section (Cách description 10px) -->
        <span class="font-be-vietnam font-light text-[14px] leading-[22px] text-black mt-[10px]">
            {{ $date }}
        </span>
    </div>
</div>

<!-- ==========================================
     DESKTOP LAYOUT (>= md)
     ========================================== -->
<div class="hidden md:flex w-full justify-center py-10 lg:py-[48px]" style="background-color: {{ $bgColor }}"
    data-aos="fade-up">

    <!--
      Max-width: 1320px dựa trên tổng width thiết kế (Left: 88, Image: 714, Gap: 116, Logo: 290, Right: 112)
      Nếu isSwapped = true -> Đảo ngược vị trí trên Desktop bằng flex-row-reverse
    -->
    <div
        class="w-full max-w-[1320px] mx-auto px-4 lg:pl-[88px] lg:pr-[112px] flex flex-col {{ $isSwapped ? 'lg:flex-row-reverse' : 'lg:flex-row' }} items-center lg:items-start justify-between gap-12 lg:gap-[116px]">

        <!-- ==========================================
             COLUMN 1: IMAGE & TEXT (Max width 714px)
             ========================================== -->
        <div class="flex flex-col w-full lg:max-w-[714px] flex-shrink-0">

            <!-- Main Image (714x714 trên Desktop) -->
            <div class="w-full aspect-square overflow-hidden shadow-sm group bg-gray-100" data-aos="zoom-out"
                data-aos-duration="1000">
                <img src="{{ $image }}" alt="{{ $title }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
            </div>

            <!-- Text Content -->
            <div class="flex flex-col w-full mt-6 lg:mt-[28px]" data-aos="fade-up" data-aos-delay="150">
                <!-- Category (14px, weight 300, line-height 22px) -->
                <span class="font-be-vietnam font-light text-[14px] leading-[22px] text-black">
                    {{ $category }}
                </span>

                <!-- Title (18px, weight 600, line-height 22px, cách top 6px) -->
                <h3 class="font-be-vietnam font-semibold text-[18px] leading-[22px] text-black mt-1 lg:mt-[6px]">
                    {{ $title }}
                </h3>

                <!-- Divider Line (Cách top 22px, lấy line màu nâu nhạt chung của website) -->
                <div class="w-[40px] h-[2px] bg-[#C5AA82] mt-4 lg:mt-[22px]"></div>

                <!-- Description (14px, weight 300, max-width 642px, cách line 18px) -->
                <p
                    class="font-be-vietnam font-light text-[14px] leading-[22px] text-black w-full lg:max-w-[642px] mt-4 lg:mt-[18px]">
                    {{ $description }}
                </p>

                <!-- Date (14px, weight 300, cách top 18px) -->
                <span class="font-be-vietnam font-light text-[14px] leading-[22px] text-black mt-4 lg:mt-[18px]">
                    {{ $date }}
                </span>
            </div>
        </div>

        <!-- ==========================================
             COLUMN 2: LOGO (Width 290px)
             ========================================== -->
        <!-- Logic padding top theo thiết kế: Ảnh (top 48px), Logo (top 298px) => Khoảng cách bù trừ là 250px -->
        <div class="w-[200px] lg:w-[290px] flex-shrink-0 flex justify-center lg:mt-[250px]" data-aos="fade-up"
            data-aos-delay="250">
            <img src="{{ $logo }}" alt="Photojournalism Logo"
                class="w-full aspect-square object-contain transition-transform duration-500 hover:rotate-6"
                loading="lazy">
        </div>

    </div>
</div>
