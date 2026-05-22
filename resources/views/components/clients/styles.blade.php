<!-- Cấu hình thư viện AOS (Animation) -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- Import Font Oswald từ Google Fonts (Dành cho Navigation & Tags) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">

<!-- Nhúng Tailwind CSS qua CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<style>
    /* ==========================================
       1. IMPORT BE VIETNAM (TỪ LOCAL)
       Chỉ giữ lại các weight thực sự được sử dụng trong Guideline:
       100 (Thin), 300 (Light), 400 (Normal), 500 (Medium), 600 (SemiBold),
       600 italic (Footer quote), 700 (Bold), 800 (ExtraBold)
       ========================================== */
    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-Thin.ttf') }}") format('truetype');
        font-weight: 100;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-Light.ttf') }}") format('truetype');
        font-weight: 300;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-Regular.ttf') }}") format('truetype');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-Medium.ttf') }}") format('truetype');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-SemiBold.ttf') }}") format('truetype');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-SemiBoldItalic.ttf') }}") format('truetype');
        font-weight: 600;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-Bold.ttf') }}") format('truetype');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-ExtraBold.ttf') }}") format('truetype');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }

    /* ==========================================
       2. IMPORT ARCHIVO (TỪ LOCAL)
       Chỉ dùng duy nhất cho Pagination numbers: Weight 700 (Bold)
       ========================================== */
    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-Bold.ttf') }}") format('truetype');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }

    /* ==========================================
       3. RESET CSS HIỂN THỊ FONT
       ========================================== */
    body {
        overflow-x: hidden;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .text-shadow-image {
        text-shadow: 2px 4px 5px rgba(0, 0, 0, 0.10);
    }

    /* Animation cho Typing Effect */
    .typing-effect {
        opacity: 1;
    }

    .typing-word {
        display: inline-block;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        will-change: opacity, transform;
    }

    .typing-word.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    @media (prefers-reduced-motion: reduce) {

        [data-aos],
        .typing-word {
            transition: none !important;
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
        }
    }
</style>

<!-- ==========================================
     4. CẤU HÌNH TAILWIND (CHUẨN HÓA THEO GUIDELINE)
     ========================================== -->
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#1d4ed8',
                    brown: '#C5AA82',
                    /* Màu divider chính */
                    grayText: '#656663',
                    /* Màu text ngày tháng Uncategorized */
                },
                fontFamily: {
                    'sans': ['"Be Vietnam"', 'sans-serif'],
                    'be-vietnam': ['"Be Vietnam"', 'sans-serif'],
                    'oswald': ['"Oswald"', 'sans-serif'],
                    'archivo': ['"Archivo Local"', 'sans-serif'],
                },
                fontSize: {
                    /* --- OSWALD (Nav, Tags) --- */
                    'nav': ['12px', {
                        lineHeight: 'normal',
                        letterSpacing: '1.20px'
                    }], // Menu, About, Contact
                    'tag': ['16px', {
                        lineHeight: 'normal',
                        letterSpacing: '3.20px'
                    }], // Thẻ "EVENT"

                    /* --- BE VIETNAM (Headings) --- */
                    'hero-bg': ['301px', {
                        lineHeight: 'normal',
                        letterSpacing: '9.03px'
                    }], // Chữ Videography mờ phía sau
                    'hero-lg': ['75px', {
                        lineHeight: 'normal'
                    }], // Photojournalism, Faces & Places
                    'hero-lg-contact': ['75px', {
                        lineHeight: '22px'
                    }], // Contact Hero
                    'hero-md': ['48px', {
                        lineHeight: '22px'
                    }], // Detail pages P4G, Nature & Landscape
                    'hero-sm': ['44px', {
                        lineHeight: 'normal',
                        letterSpacing: '4.40px'
                    }], // Event photography, Photojournalism (Home)

                    'h-hello': ['40px', {
                        lineHeight: '40px'
                    }], // About: Hello,
                    'h-section-36': ['36px', {
                        lineHeight: 'normal',
                        letterSpacing: '2.88px'
                    }], // Google will change..., Categories F&P
                    'h-section-32': ['32px', {
                        lineHeight: 'normal'
                    }], // Contact: I'm always ready...

                    'h-sub-24-wide': ['24px', {
                        lineHeight: 'normal',
                        letterSpacing: '2.40px'
                    }], // Follow me on instagram, Partners
                    'h-sub-24-norm': ['24px', {
                        lineHeight: '25px'
                    }], // Welcome to La Hieu
                    'h-sub-24-foot': ['24px', {
                        lineHeight: 'normal',
                        letterSpacing: '1.20px'
                    }], // Nguyễn Đức Hiếu, 090..., pvduc...

                    'h-card-20-wide': ['20px', {
                        lineHeight: 'normal',
                        letterSpacing: '2.00px'
                    }], // Watch now
                    'h-card-20-norm': ['20px', {
                        lineHeight: 'normal'
                    }], // P4G, Goethe
                    'h-card-18': ['18px', {
                        lineHeight: '22px'
                    }], // Modern & Trendy App Designs

                    /* --- BE VIETNAM (Body) --- */
                    'body-18-wide': ['18px', {
                        lineHeight: 'normal',
                        letterSpacing: '0.90px'
                    }], // Descriptions trang chủ
                    'body-16-tall': ['16px', {
                        lineHeight: '23px'
                    }], // Content Detail trang Photojournalism
                    'body-16-norm': ['16px', {
                        lineHeight: '22px'
                    }], // Content About, Unposed emotions
                    'body-14': ['14px', {
                        lineHeight: '22px'
                    }], // Uncategorized, Date, Card desc

                    /* --- SPECIAL --- */
                    'dropcap': ['78px', {
                        lineHeight: '22px'
                    }], // Chữ E đầu dòng
                    'paginate': ['17px', {
                        lineHeight: '25.50px'
                    }], // Archivo pagination
                },
                fontWeight: {
                    'thin': '100', // Dùng cho "Unposed emotions. The true pulse..."
                    'light': '300', // Body text chính
                    'normal': '400', // Welcome, Hello, Liên hệ
                    'medium': '500', // Description ở Trang chủ (Event, Photojournalism)
                    'semibold': '600', // Footer tên, Quote Italic, Tên Card
                    'bold': '700', // Tiêu đề trang Contact, Chi tiết Event, Pagination
                    'extrabold': '800', // Tiêu đề Home (Event, Photojournalism, Faces), Section
                }
            }
        }
    }
</script>
