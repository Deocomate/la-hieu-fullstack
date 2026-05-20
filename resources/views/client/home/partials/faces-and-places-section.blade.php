<section class="w-full bg-white px-4 lg:px-[31px] pt-12 lg:pt-[80px] pb-12 lg:pb-[55px] flex flex-col items-center">

    <!-- Section Title -->
    <!-- Dùng text-heading (44px), extrabold và tracking-heading (4.4px) từ file config -->
    <h2
        class="font-be-vietnam font-extrabold text-3xl lg:text-heading uppercase tracking-heading text-black text-center typing-effect">
        faces & places
    </h2>

    <!-- Masonry Grid Container -->
    <!-- Khoảng cách từ Title đến Grid là ~80px.
         Responsive: Mobile (2 cột) -> Tablet (4 cột) -> Desktop nhỏ (6 cột) -> Desktop chuẩn (8 cột).
         Khoảng cách giữa các ảnh (gap) là ~12px dựa theo số liệu chia đều của thiết kế. -->
    <div
        class="w-full mt-10 lg:mt-[80px] mx-auto columns-2 md:columns-4 lg:columns-6 xl:columns-8 gap-3 lg:gap-[12px]">

        @php
            // Mảng chứa 19 ảnh từ danh sách file bạn đã cung cấp
            $totalImages = 19;
        @endphp

        @for ($i = 1; $i <= $totalImages; $i++)
            <!-- Wrapper của mỗi ảnh:
                 - break-inside-avoid: Ngăn không cho ảnh bị cắt làm đôi giữa 2 cột
                 - mb-[12px]: Khoảng cách dọc giữa các ảnh -->
            <div
                class="break-inside-avoid mb-3 lg:mb-[12px] w-full overflow-hidden shadow-sm group cursor-pointer relative bg-gray-100 rounded-sm"
                data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 100 }}">

                <img src="{{ asset('client/assets/static/home/faces-and-places-' . $i . '.png') }}"
                    alt="Faces and Places {{ $i }}"
                    class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-110"
                    loading="lazy">

                <!-- Hiệu ứng overlay nhẹ khi hover để tăng cảm giác tương tác (Tùy chọn, bạn có thể giữ hoặc bỏ) -->
                <div
                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500 pointer-events-none">
                </div>
            </div>
        @endfor

    </div>

    <!-- Section Description -->
    <!-- Khoảng cách từ dưới cùng của grid đến chữ là ~61px. Dùng text-desc (18px), font-light, tracking-desc (0.9px) -->
    <p
        class="font-be-vietnam font-light text-base lg:text-desc tracking-desc text-black text-center max-w-[728px] mt-10 lg:mt-[61px] mx-auto" data-aos="fade-up">
        This collection is a visual diary of the roads I have traveled and the people<br class="hidden md:inline" />
        I have met. More than just coordinates or portraits, these images preserve<br class="hidden md:inline" />
        the raw, real emotions of a specific fraction in time.
    </p>

</section>
