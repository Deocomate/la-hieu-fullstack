<section class="w-full bg-[#FAFAFA] flex items-center justify-center overflow-hidden py-12 lg:py-0 lg:h-[765px] lg:mb-[50px]">
    <!-- Container chính: max-width 1600px, padding hai bên 128px theo đúng thiết kế -->
    <div
        class="w-full max-w-[1600px] h-full mx-auto px-6 sm:px-12 lg:px-[128px] flex flex-col lg:flex-row lg:gap-[74px] items-start">

        <!-- ==========================================
             CỘT TRÁI: CONTACT TITLE & MAIN IMAGE
             ========================================== -->
        <!-- Image width 613px theo thiết kế -->
        <div class="w-full lg:w-[613px] flex-shrink-0 flex flex-col pt-0 lg:pt-[96px]">
            <!-- Contact Title -->
            <!-- Size 75px, Bold 700, Line-height 22px -->
            <h1
                class="font-be-vietnam font-bold text-[44px] sm:text-[60px] lg:text-[75px] text-black uppercase leading-none typing-effect">
                contact
            </h1>

            <!-- Main Image -->
            <!-- Image top là 205px. Title top là 96px + line-height 22px = 118px. Khoảng cách = 205 - 118 = 87px -->
            <!-- Kích thước chuẩn: 613x460 -->
            <div class="w-full h-auto lg:h-[460px] mt-8 lg:mt-[87px] overflow-hidden bg-gray-100 shadow-sm" data-aos="zoom-out" data-aos-duration="1000">
                <img src="{{ asset('client/assets/static/contact/contact-main-image.png') }}"
                    alt="La Hieu Photography Contact Journey" class="w-full h-full object-cover" loading="lazy">
            </div>
        </div>

        <!-- ==========================================
             CỘT PHẢI: DESCRIPTION & INFO FIELDS
             ========================================== -->
        <!-- Right col width 645px. Bắt đầu từ toạ độ top 251px -->
        <div class="w-full lg:w-[645px] flex-shrink-0 flex flex-col mt-10 lg:mt-0 pt-0 lg:pt-[251px]">

            <!-- Description -->
            <!-- Size 32px, Light 300 -->
            <p
                class="font-be-vietnam font-light text-[24px] sm:text-[28px] lg:text-[32px] text-black leading-snug sm:leading-normal typing-effect">
                I'm always ready for the next journey<br />
                Let’s talk about yours
            </p>

            <!-- Đường kẻ ngang (Cách trên 50px, cách dưới 50px) -->
            <div class="w-full h-[1px] bg-black/10 mt-8 mb-8 lg:mt-[50px] lg:mb-[50px]" data-aos="fade"></div>

            <!-- ==========================================
                 KHỐI THÔNG TIN (PHONE, EMAIL, SOCIAL)
                 ========================================== -->
            <div class="w-full flex flex-col sm:flex-row items-start relative" data-aos="fade-up" data-aos-delay="200">

                <!-- NHÓM BÊN TRÁI: Phone & Email -->
                <!-- Toạ độ cột trái là 815, cột phải là 1220 => Khoảng cách ngang bằng đúng 405px -->
                <div class="w-full sm:w-[250px] lg:w-[405px] flex-shrink-0 flex flex-col gap-8 lg:gap-[50px]">
                    <!-- Phone Number -->
                    <div class="flex flex-col gap-2 lg:gap-[10px]">
                        <h4
                            class="font-be-vietnam font-semibold text-[18px] lg:text-[20px] text-black uppercase tracking-wide">
                            Phone number
                        </h4>
                        <a href="tel:0902222876"
                            class="font-be-vietnam font-light text-[15px] lg:text-[16px] text-black hover:opacity-70 transition-opacity w-max">
                            090 2222 876
                        </a>
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col gap-2 lg:gap-[10px]">
                        <h4
                            class="font-be-vietnam font-semibold text-[18px] lg:text-[20px] text-black uppercase tracking-wide">
                            email
                        </h4>
                        <a href="mailto:pvduchieu@gmail.com"
                            class="font-be-vietnam font-light text-[15px] lg:text-[16px] text-black hover:opacity-70 transition-opacity break-all w-max">
                            pvduchieu@gmail.com
                        </a>
                    </div>
                </div>

                <!-- NHÓM BÊN PHẢI: Social Media & Logo -->
                <div class="w-full mt-8 sm:mt-0 flex flex-col items-start">
                    <!-- Social Media -->
                    <div class="flex flex-col gap-2 lg:gap-[10px]">
                        <h4
                            class="font-be-vietnam font-semibold text-[18px] lg:text-[20px] text-black uppercase tracking-wide">
                            social media
                        </h4>
                        <!-- Không có thẻ <a> trong yêu cầu nhưng bổ sung UX nếu cần. Nếu giữ nguyên string thì dùng thẻ span -->
                        <span
                            class="font-be-vietnam font-light text-[15px] lg:text-[16px] text-black cursor-pointer hover:opacity-70 transition-opacity">
                            lahieuphotography
                        </span>
                    </div>

                    <!-- Signature Logo -->
                    <!-- Top của logo là 596px, Top của Email value cũng là 596px => mt-[105px] đảm bảo căn ngang tuyệt đối với dòng Email -->
                    <!-- Size logo theo config là 184x92 -->
                    <div class="mt-8 lg:mt-[105px]">
                        <img src="{{ asset('client/assets/static/contact/logo.svg') }}" alt="La Hieu Signature"
                            class="w-[120px] lg:w-[184px] h-auto lg:h-[92px] object-contain" loading="lazy">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
