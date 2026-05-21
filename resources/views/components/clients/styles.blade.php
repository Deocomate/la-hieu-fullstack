<!-- Cấu hình thư viện AOS (Animation) -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- Import Font Oswald từ Google Fonts do không có trong thư mục local -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

<!-- Nhúng Tailwind CSS qua CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<style>
    /* ==========================================
       1. IMPORT BE VIETNAM (TỪ LOCAL)
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
        src: url("{{ asset('client/assets/fonts/BeVietnam-ThinItalic.ttf') }}") format('truetype');
        font-weight: 100;
        font-style: italic;
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
        src: url("{{ asset('client/assets/fonts/BeVietnam-LightItalic.ttf') }}") format('truetype');
        font-weight: 300;
        font-style: italic;
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
        src: url("{{ asset('client/assets/fonts/BeVietnam-Italic.ttf') }}") format('truetype');
        font-weight: 400;
        font-style: italic;
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
        src: url("{{ asset('client/assets/fonts/BeVietnam-MediumItalic.ttf') }}") format('truetype');
        font-weight: 500;
        font-style: italic;
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
        src: url("{{ asset('client/assets/fonts/BeVietnam-BoldItalic.ttf') }}") format('truetype');
        font-weight: 700;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-ExtraBold.ttf') }}") format('truetype');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-ExtraBoldItalic.ttf') }}") format('truetype');
        font-weight: 800;
        font-style: italic;
        font-display: swap;
    }

    /* ==========================================
       2. IMPORT ARCHIVO (TỪ LOCAL)
       ========================================== */
    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-Thin.ttf') }}") format('truetype');
        font-weight: 100;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-ThinItalic.ttf') }}") format('truetype');
        font-weight: 100;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-ExtraLight.ttf') }}") format('truetype');
        font-weight: 200;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-ExtraLightItalic.ttf') }}") format('truetype');
        font-weight: 200;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-Light.ttf') }}") format('truetype');
        font-weight: 300;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-LightItalic.ttf') }}") format('truetype');
        font-weight: 300;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-Regular.ttf') }}") format('truetype');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-Italic.ttf') }}") format('truetype');
        font-weight: 400;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-Medium.ttf') }}") format('truetype');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-MediumItalic.ttf') }}") format('truetype');
        font-weight: 500;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-SemiBold.ttf') }}") format('truetype');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-SemiBoldItalic.ttf') }}") format('truetype');
        font-weight: 600;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-Bold.ttf') }}") format('truetype');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-BoldItalic.ttf') }}") format('truetype');
        font-weight: 700;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-ExtraBold.ttf') }}") format('truetype');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-ExtraBoldItalic.ttf') }}") format('truetype');
        font-weight: 800;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-Black.ttf') }}") format('truetype');
        font-weight: 900;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo-BlackItalic.ttf') }}") format('truetype');
        font-weight: 900;
        font-style: italic;
        font-display: swap;
    }

    /* ==========================================
       3. RESET CSS HIỂN THỊ FONT
       ========================================== */
    body {
        overflow-x: hidden;
    }

    .text-shadow-image {
        text-shadow: 2px 4px 5px rgba(0, 0, 0, 0.10);
    }

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
     4. CẤU HÌNH TAILWIND
     ========================================== -->
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#1d4ed8',
                },
                fontFamily: {
                    'sans': ['"Be Vietnam"', 'sans-serif'],
                    'be-vietnam': ['"Be Vietnam"', 'sans-serif'],
                    'oswald': ['"Oswald"', 'sans-serif'],
                    /* Đã đổi sang Oswald từ Google Fonts */
                    'archivo': ['"Archivo Local"', 'sans-serif'],
                },
                fontSize: {
                    'nav': ['12px', {
                        lineHeight: 'normal',
                        letterSpacing: '1.20px'
                    }],
                    'body': ['16px', {
                        lineHeight: '22px'
                    }],
                    'desc': ['18px', {
                        lineHeight: 'normal',
                        letterSpacing: '0.90px'
                    }],
                    'sub': ['20px', {
                        lineHeight: 'normal',
                        letterSpacing: '2.40px'
                    }],
                    'title': ['24px', {
                        lineHeight: '25px'
                    }],
                    'heading': ['44px', {
                        lineHeight: 'normal',
                        letterSpacing: '4.40px'
                    }],
                },
                fontWeight: {
                    'thin': '100',
                    'extralight': '200',
                    /* Bổ sung Extra Light cho chuẩn Archivo */
                    'light': '300',
                    'normal': '400',
                    'medium': '500',
                    'semibold': '600',
                    'bold': '700',
                    'extrabold': '800',
                    'black': '900',
                }
            }
        }
    }
</script>
