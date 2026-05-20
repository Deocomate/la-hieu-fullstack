@props([
    'bgColor' => 'transparent', // Nhận mã màu, ví dụ: '#FAFAFA' hoặc 'transparent'
    'isSwapped' => false, // true: Logo bên trái, Ảnh & Text bên phải
    'image' => asset('client/assets/static/photojournalism/photo-image-card-1.png'),
    'logo' => asset('client/assets/static/photojournalism/photo-logo-card-1.svg'),
    'category' => 'Uncategorized',
    'title' => 'Mordern & Trendy App Designs',
    'description' =>
        'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event. Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character.',
    'date' => 'August 6, 2020',
])

<!-- Card Container -->
<div class="w-full flex justify-center py-10 lg:py-[48px]" style="background-color: {{ $bgColor }}" data-aos="fade-up">

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
            <div class="w-full aspect-square overflow-hidden shadow-sm group bg-gray-100" data-aos="zoom-out" data-aos-duration="1000">
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
                <div class="w-[40px] h-[1px] bg-[#C5AA82] mt-4 lg:mt-[22px]"></div>

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
        <div class="w-[200px] lg:w-[290px] flex-shrink-0 flex justify-center lg:mt-[250px]" data-aos="fade-up" data-aos-delay="250">
            <img src="{{ $logo }}" alt="Photojournalism Logo"
                class="w-full aspect-square object-contain transition-transform duration-500 hover:rotate-6"
                loading="lazy">
        </div>

    </div>
</div>
