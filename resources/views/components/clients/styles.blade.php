<!-- Cấu hình Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<!-- Đã gom chung Be Vietnam Pro (all weights), Oswald và Archivo vào 1 thẻ link -->
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700&family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Oswald:wght@400;500;600;700&display=swap" rel="stylesheet">

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>

<!-- Cấu hình Tailwind -->
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#1d4ed8',
                },
                fontFamily: {
                    // Set Be Vietnam Pro làm font sans mặc định cho toàn bộ body
                    'sans': ['"Be Vietnam Pro"', 'sans-serif'], 
                    // Bắt buộc phải có ngoặc kép "" bọc tên font có khoảng trắng
                    'be-vietnam': ['"Be Vietnam Pro"', 'sans-serif'],
                    'oswald': ['VNF-Oswald', 'Oswald', 'sans-serif'],
                    'archivo': ['Archivo', 'sans-serif'],
                },
                fontSize: {
                    'nav': '12px',
                    'body': ['16px', { lineHeight: '22px' }],
                    'desc': '18px',
                    'sub': '20px',
                    'title': ['24px', { lineHeight: '25px' }],
                    'heading': '44px',
                },
                letterSpacing: {
                    'desc': '0.90px',
                    'nav': '1.20px',
                    'btn': '2.00px',
                    'sub': '2.40px',
                    'tag': '3.20px',
                    'heading': '4.40px',
                }
            }
        }
    }
</script>

<style>
    /* Làm mịn font chữ trên MacOS/iOS */
    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        overflow-x: hidden;
    }

    /* Hiệu ứng bóng đổ cho chữ trên nền ảnh */
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
