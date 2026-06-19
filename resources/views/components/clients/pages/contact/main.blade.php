<section
    class="w-full bg-white md:bg-[#FAFAFA] flex items-center justify-center overflow-hidden pb-[50px] md:py-12 lg:py-0 lg:mb-[50px]">
    <!-- Container chính: max-width 1600px, padding hai bên 35px trên mobile và đổi về cấu hình cũ trên desktop -->
    <div
        class="w-full max-w-[1600px] h-full mx-auto px-[35px] md:px-6 lg:px-[128px] md:pb-[70px] flex flex-col lg:flex-row lg:gap-[74px] items-start">

        <!-- ==========================================
             CỘT TRÁI: CONTACT TITLE & MAIN IMAGE
             ========================================== -->
        <!-- Image width 613px theo thiết kế desktop, thêm padding-top phù hợp trên mobile -->
        <div class="w-full lg:w-[613px] flex-shrink-0 flex flex-col pt-[40px] md:pt-[96px]">
            <!-- Contact Title -->
            <!-- Căn giữa trên mobile (text-center), căn trái trên desktop (md:text-left) -->
            @php
                $contactImageSrc = \App\Support\ClientImage::url(
                    $page->hero_images['contact_image'] ?? null,
                    'assets/static/contact/contact-main-image.png',
                );
            @endphp
            <h1
                class="font-be-vietnam text-[36px] md:text-hero-lg-contact font-extrabold md:font-bold tracking-[1.8px] md:tracking-normal text-black text-center md:text-left uppercase typing-effect">
                {{ $page->hero_title ?? 'contact' }}
            </h1>

            <!-- Main Image -->
            <!-- Khoảng cách CONTACT -> Hero Image: 30px trên mobile (mt-[30px]), 87px trên desktop (md:mt-[87px]) -->
            <div class="w-full h-auto lg:h-[460px] mt-[30px] md:mt-[87px] overflow-hidden bg-gray-100 shadow-sm"
                data-aos="zoom-out" data-aos-duration="1000">
                <img src="{{ $contactImageSrc }}"
                    alt="La Hieu Photography Contact Journey" class="w-full h-full object-cover" loading="lazy">
            </div>
        </div>

        <!-- ==========================================
             CỘT PHẢI: DESCRIPTION & INFO FIELDS
             ========================================== -->
        <div class="w-full lg:w-[645px] flex-shrink-0 flex flex-col mt-0 lg:mt-0 pt-0 lg:pt-[251px]">

            <!-- Description -->
            <!-- Khoảng cách từ ảnh đến intro text: 33px trên mobile (mt-[33px]), 50px trên desktop (md:mt-[50px]) -->
            <p
                class="font-be-vietnam text-[20px] md:text-h-section-32 font-light text-black text-left typing-effect mt-[30px] md:mt-[15px]">
                {!! nl2br(e($page->hero_description ?? "I'm always ready for the next journey\nLet's talk about yours")) !!}
            </p>

            <!-- Đường kẻ ngang -->
            <!-- Intro text -> Divider: 20px (mt-[20px]) | Divider -> Heading Row: 30px (mb-[30px]) -->
            <div class="w-full h-[1px] bg-black/10 mt-[20px] md:mt-[50px] mb-[30px] md:mb-[50px]" data-aos="fade"></div>

            <!-- ==========================================
                 KHỐI THÔNG TIN (PHONE, EMAIL, SOCIAL)
                 ========================================== -->
            <!-- flex-row trên mobile để giữ 2 cột side-by-side theo thiết kế -->
            <div class="w-full flex flex-row sm:flex-row items-start justify-between relative" data-aos="fade-up"
                data-aos-delay="200">

                <!-- NHÓM BÊN TRÁI: Phone & Email -->
                <!-- Chiếm 48% chiều rộng trên mobile để cân đối, khoảng cách giữa Phone và Email: 59px (gap-[59px]) -->
                <div
                    class="w-[48%] sm:w-[250px] lg:w-[405px] flex-shrink-0 flex flex-col gap-[59px] md:gap-8 lg:gap-[50px]">
                    <!-- Phone Number -->
                    <!-- PHONE NUMBER -> Phone number text: 10px (gap-[10px]) -->
                    <div class="flex flex-col gap-[10px] md:gap-2 lg:gap-[10px]">
                        <h4 class="font-be-vietnam text-[16px] md:text-[20px] font-semibold text-black uppercase">
                            Phone number
                        </h4>
                        @php
                            $contactPhone = $settings['contact_phone'] ?? ($page->content['phone'] ?? '090 2222 876');
                            $contactEmail = $settings['contact_email'] ?? ($page->content['email'] ?? 'pvduchieu@gmail.com');
                            $contactSocial = $settings['social_instagram'] ?? ($page->content['social'] ?? 'lahieuphotography');
                        @endphp
                        <a href="tel:{{ preg_replace('/\D+/', '', $contactPhone) }}"
                            class="font-be-vietnam text-[14px] md:text-body-16-norm font-light text-black hover:opacity-70 transition-opacity w-max">
                            {{ $contactPhone }}
                        </a>
                    </div>

                    <!-- Email -->
                    <!-- EMAIL -> Email address: 10px (gap-[10px]) -->
                    <div class="flex flex-col gap-[10px] md:gap-2 lg:gap-[10px]">
                        <h4 class="font-be-vietnam text-[16px] md:text-[20px] font-semibold text-black uppercase">
                            email
                        </h4>
                        <a href="mailto:{{ $contactEmail }}"
                            class="font-be-vietnam text-[14px] md:text-body-16-norm font-light text-black hover:opacity-70 transition-opacity break-all w-max">
                            {{ $contactEmail }}
                        </a>
                    </div>
                </div>

                <!-- NHÓM BÊN PHẢI: Social Media & Logo -->
                <!-- Chiếm 48% chiều rộng trên mobile để khớp với cột trái -->
                <div class="w-[48%] sm:w-auto mt-0 flex flex-col items-start">
                    <!-- Social Media -->
                    <!-- SOCIAL MEDIA -> Social media text: 10px (gap-[10px]) -->
                    <div class="flex flex-col gap-[10px] md:gap-2 lg:gap-[10px] self-end">
                        <h4 class="font-be-vietnam text-[16px] md:text-[20px] font-semibold text-black uppercase">
                            social media
                        </h4>
                        <span
                            class="font-be-vietnam text-[14px] md:text-body-16-norm font-light text-black cursor-pointer hover:opacity-70 transition-opacity">
                            {{ $contactSocial }}
                        </span>
                    </div>

                    <!-- Signature Logo -->
                    <!-- Social media text -> Signature logo: 48px (mt-[48px]) -->
                    <!-- Căn lệch phải trên mobile (self-end) tạo điểm nhấn, căn trái trên desktop (sm:self-start) -->
                    <div class="mt-[48px] md:mt-8 lg:mt-[105px] self-end sm:self-start">
                        <img src="{{ asset('assets/static/contact/logo.svg') }}" alt="La Hieu Signature"
                            class="w-[140px] lg:w-[184px] h-auto lg:h-[92px] object-contain" loading="lazy">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
