<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Là Hiếu - @yield('title')</title>
    <!-- Gọi file styles chứa Tailwind CDN -->
    @include('components.clients.styles')
    @stack('styles')
</head>
<!-- Thêm class font-sans để áp dụng Be Vietnam Pro làm mặc định -->

<body class="font-sans text-black bg-white">
    @include('components.clients.header')

    <main>
        @yield('content')
    </main>

    @include('components.clients.footer')
    @include('components.clients.scripts')
    @stack('scripts')
</body>

</html>
