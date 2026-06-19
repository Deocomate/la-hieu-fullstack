# Do Not Use Vite

## Mục đích
Quy định việc quản lý assets tĩnh (CSS, JS) trong dự án. Dự án này **không** sử dụng Vite hay bất kỳ build tool nào từ Node.js (npm). Tất cả CSS và JS đều dùng CDN để tối ưu tốc độ phát triển và sự đơn giản.

## Quy tắc
1. **Tuyệt đối KHÔNG SỬ DỤNG Vite, npm, node_modules.**
2. **KHÔNG** chạy các lệnh `npm install`, `npm run dev`, `npm run build`.
3. **KHÔNG** thêm các file cấu hình như `package.json`, `vite.config.js`, `tailwind.config.js`, `postcss.config.js`.
4. **Tailwind CSS:** CHỈ SỬ DỤNG Tailwind CDN `<script src="https://cdn.tailwindcss.com"></script>`.
5. **Cấu hình Tailwind:** Nếu cần cấu hình custom theme (extend colors, fonts...), hãy viết trực tiếp vào `<script> tailwind.config = { ... } </script>` trong `resources/views/components/clients/chrome/styles.blade.php`.
6. **Thư viện khác (JS/CSS libraries):** Chỉ dùng phiên bản CDN, ví dụ Alpine.js, jQuery, v.v. Không cài đặt local qua npm.
7. **Tránh:** KHÔNG dùng directive `@vite` trong bất kỳ file Blade nào.

Dự án ưu tiên sự đơn giản tối đa ở frontend tooling. Mọi tác vụ serve web chỉ dựa trên `php artisan serve`.
