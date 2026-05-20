<section class="w-full bg-white  pb-16 lg:pb-[98px] px-4 lg:px-[30px] flex flex-col items-center">

    <!-- Section Title -->
    <!-- Font size 24px, weight 800 (extrabold), tracking 2.4px -->
    <h2
        class="font-be-vietnam font-extrabold text-[20px] md:text-[24px] uppercase tracking-[2.4px] text-black text-center typing-effect">
        Follow me on instagram
    </h2>

    <!-- Instagram Images Container -->
    <!-- Dùng Flexbox. mt-[87px] theo đúng thiết kế -->
    <div class="w-full mt-10 lg:mt-[87px] flex flex-wrap md:flex-nowrap">

        @for ($i = 1; $i <= 5; $i++)
            <!-- Image Item -->
            <!--
                Desktop (md trở lên): w-1/5 (20%) -> Xếp đúng 5 ảnh trên 1 hàng
                Mobile (< md): w-1/2 (50%) -> Rớt dòng 2 ảnh 1 hàng để tránh ảnh quá nhỏ
                aspect-square: Bắt buộc thẻ div này luôn là hình vuông (Width = Height)
            -->
            <a href="#" target="_blank" rel="noopener noreferrer"
                class="w-1/2 md:w-1/5 aspect-square relative group overflow-hidden block"
                data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">

                <img src="{{ asset('client/assets/static/home/follow-me-' . $i . '.png') }}"
                    alt="Instagram Feed {{ $i }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    loading="lazy">

                <!-- Overlay đen nhẹ hiện ra khi di chuột (Hiệu ứng tương tác UI) -->
                <div
                    class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                </div>

            </a>
        @endfor

    </div>

</section>
