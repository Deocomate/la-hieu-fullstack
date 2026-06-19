<section
    class="w-full bg-white md:pt-16 pb-[50.2px] md:pb-[100px] px-0 md:px-4 lg:px-[30px] flex flex-col items-center overflow-hidden">
    <!-- Section Title -->
    <!-- Căn giữa tuyệt đối, bổ sung padding 2 bên trên mobile để tránh sát mép màn hình -->
    <h2
        class="font-be-vietnam text-[18px] md:text-h-sub-24-wide font-extrabold tracking-[0.9px] md:tracking-[2.4px] uppercase text-black text-center typing-effect px-[30px] md:px-0">
        Follow me on instagram
    </h2>

    <!-- Instagram Images Container -->
    <!--
        Mobile (< md): Cuộn ngang (overflow-x-auto), loại bỏ khoảng trống (gap-0), ẩn thanh cuộn.
        Desktop (>= md): Quay lại hiển thị flex-row không wrap, căn chỉnh theo thiết lập ban đầu.
    -->
    <div
        class="w-full mt-[50px] md:mt-[80px] flex flex-row md:flex-nowrap overflow-x-auto md:overflow-visible snap-x snap-mandatory [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

        @foreach ($socialFeeds as $index => $feed)
            <!-- Image Item -->
            <!--
                Mobile (< md): Kích thước cố định 307.8px x 307.8px, sát mép nhau (gap-0), hỗ trợ snap scroll.
                Desktop (>= md): Chia đều 1/5 chiều rộng (20%), tỉ lệ khung hình vuông (aspect-square).
            -->
            <a href="{{ $feed->post_url ?: '#' }}" target="_blank" rel="noopener noreferrer"
                class="w-[307.8px] h-[307.8px] md:w-1/5 md:h-auto md:aspect-square relative group overflow-hidden block flex-shrink-0 snap-start"
                data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">

                <img src="{{ \App\Support\ClientImage::url($feed->image_url) }}"
                    alt="{{ ucfirst($feed->platform) }} Feed {{ $index + 1 }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    loading="lazy">

                <!-- Overlay đen nhẹ hiện ra khi di chuột -->
                <div
                    class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                </div>

            </a>
        @endforeach

    </div>
</section>
