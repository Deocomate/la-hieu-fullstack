<!-- Cấu hình thư viện AOS (Animation) -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<!-- Nhúng Tailwind CSS qua CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<style>
    /* ==========================================
       1. IMPORT BE VIETNAM (TỪ LOCAL CỦA FIGMA)
       ========================================== */
    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-Thin_1.ttf') }}") format('truetype');
        font-weight: 100;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-Light_1.ttf') }}") format('truetype');
        font-weight: 300;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-Regular_1.ttf') }}") format('truetype');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-Medium_1.ttf') }}") format('truetype');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-SemiBold_1.ttf') }}") format('truetype');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-SemiBoldItalic_1.ttf') }}") format('truetype');
        font-weight: 600;
        font-style: italic;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-Bold_1.ttf') }}") format('truetype');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Be Vietnam';
        src: url("{{ asset('client/assets/fonts/BeVietnam-ExtraBold_1.ttf') }}") format('truetype');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }

    /* ==========================================
       2. IMPORT OSWALD & ARCHIVO (TỪ LOCAL)
       ========================================== */
    @font-face {
        font-family: 'Oswald Local';
        src: url("{{ asset('client/assets/fonts/Oswald_wght__2.ttf') }}") format('truetype');
        font-weight: 100 900;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Archivo Local';
        src: url("{{ asset('client/assets/fonts/Archivo_wdth_wght__1.ttf') }}") format('truetype');
        font-weight: 100 900;
        font-style: normal;
        font-display: swap;
    }

    /* ==========================================
       3. RESET CSS HIỂN THỊ FONT
       ========================================== */
    body {
        /* -webkit-font-smoothing: antialiased; */
        /* -moz-osx-font-smoothing: grayscale; */
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
                    /* Ánh xạ tên Font y hệt trong phần @font-face */
                    'sans': ['"Be Vietnam"', 'sans-serif'],
                    'be-vietnam': ['"Be Vietnam"', 'sans-serif'],
                    'oswald': ['"Oswald Local"', 'sans-serif'],
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
