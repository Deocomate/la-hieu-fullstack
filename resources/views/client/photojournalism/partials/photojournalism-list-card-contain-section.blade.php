<section class="photojournalism-list-card-contain-section w-full max-w-[1320px] mx-auto pb-20">
    <!-- Sử dụng flex-col và gap để tạo khoảng cách chính xác giữa các card -->
    <div class="w-full flex flex-col gap-[25px]">

        @for ($i = 0; $i < 4; $i++)
            @php
                // 1. Logic Background: Card đầu tiên (index = 0) có màu xám, các card sau trong suốt
                $bgColor = $i === 0 ? 'rgba(250, 250, 250, 1)' : 'transparent';

                // 2. Logic Swap: Đảo tuần tự (index 0: Không swap, index 1: Swap, index 2: Không swap,...)
                $isSwapped = $i % 2 !== 0;

                // 3. Logic Hình ảnh: Luân phiên dùng ảnh 1 và 2 (Vì trong folder của bạn chỉ có 2 file)
                $assetIndex = ($i % 2) + 1;
            @endphp

            <!-- Gọi Component và truyền biến vào -->
            @include('client.photojournalism.partials.photojournalism-card', [
                'bgColor' => $bgColor,
                'isSwapped' => $isSwapped,
                'image' => asset("client/assets/static/photojournalism/photo-image-card-{$assetIndex}.png"),
                'logo' => asset("client/assets/static/photojournalism/photo-logo-card-{$assetIndex}.svg"),
            
                // Dummy data text để test
                'title' => 'Mordern & Trendy App Designs ' . ($i + 1),
                'category' => 'Uncategorized',
                'date' => 'August 6, 2020',
                'description' =>
                    'Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character of the event. Even in the middle of a vibrant crowd, I am always looking for the same thing: the raw, genuine moments that define the true character.',
            ])
        @endfor

    </div>

    <!-- ==========================================
         2. PAGINATION (Căn giữa bằng Flexbox)
         ========================================== -->
    <!-- Margin top 64px (mt-16) cách List Card -->
    <div class="w-full flex justify-center mt-12 lg:mt-16 px-4" data-aos="fade-up">
        @include('components.clients.pagination')
    </div>
</section>
