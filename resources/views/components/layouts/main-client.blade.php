<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-clients.chrome.seo-meta
        :title="$seo['title'] ?? null"
        :description="$seo['description'] ?? null"
        :image="$seo['image'] ?? null"
    />
    <!-- Gọi file styles chứa Tailwind CDN -->
    <x-clients.chrome.styles />
    @stack('styles')
</head>
<!-- Thêm class font-sans để áp dụng Be Vietnam Pro làm mặc định -->

<body class="font-sans text-black bg-white">
    <x-clients.chrome.header />

    <main>
        @yield('content')
    </main>

    <x-clients.chrome.footer />
    <x-clients.gallery.lightbox />
    <x-clients.chrome.scripts />
    @stack('scripts')
</body>

</html>
