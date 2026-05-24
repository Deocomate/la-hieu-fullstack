# 📸 La Hieu Photography - Fullstack Portfolio

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/FilamentPHP-v5-F59E0B?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)

Dự án website Portfolio cá nhân dành cho nhiếp ảnh gia **Là Hiếu**. Hệ thống được xây dựng với kiến trúc Fullstack, cung cấp trải nghiệm giao diện người dùng mượt mà, giàu tính nghệ thuật cùng hệ thống quản trị nội dung (CMS) mạnh mẽ để quản lý các tác phẩm nhiếp ảnh, video và bài báo.

---

## 🌟 Tính năng nổi bật

### 🎨 Giao diện người dùng (Client-side)

- **Thiết kế Pixel-Perfect & Đậm chất nghệ thuật:** Giao diện được thiết kế riêng biệt, sử dụng hệ thống Typography cao cấp (`Be Vietnam`, `Oswald`, `Archivo`).
- **Hiệu ứng mượt mà:** Tích hợp `AOS` (Animate On Scroll) và `Swiper.js` tạo hiệu ứng cuộn, lazy-load ảnh và thư viện Slider chuyên nghiệp.
- **Responsive 100%:** Tương thích hoàn hảo trên mọi thiết bị (Mobile, Tablet, Desktop).
- **Các phân hệ chính:**
    - `Trang chủ`: Tổng quan về tác giả, hình ảnh sự kiện, Photojournalism, Videography.
    - `About`: Giới thiệu tiểu sử nhiếp ảnh gia.
    - `Event Photos` & `Faces and Places`: Thư viện ảnh dạng Grid/Masonry độc đáo.
    - `Photojournalism` & `Videography`: Tin tức, bài báo hình ảnh và tích hợp Youtube video.
    - `Contact`: Thông tin liên hệ.

### ⚙️ Hệ thống quản trị (Admin-side)

- Tích hợp **FilamentPHP v5** - Framework Admin Panel mạnh mẽ và hiện đại nhất của hệ sinh thái Laravel.
- **Quản lý quyền truy cập (RBAC):** Phân quyền cơ bản giữa `Super Admin` và `Admin`.
- Hệ thống CSDL đã được thiết kế sẵn sàng cho:
    - Quản lý Album Sự kiện (`event_albums`), Địa điểm (`faces_places_albums`).
    - Quản lý Bài viết báo chí & Video (`articles`, `article_categories`).
    - Quản lý Đối tác (`partners`), Mạng xã hội (`social_feeds`), Cài đặt chung (`settings`).
    - Hệ thống lưu trữ ảnh tập trung (`media`).

---

## 🛠 Tech Stack (Công nghệ sử dụng)

- **Backend:** Laravel 12.x, PHP >= 8.2
- **Admin Panel:** FilamentPHP v5, Livewire v4
- **Frontend:** Blade Template, Tailwind CSS, Alpine.js
- **Thư viện UI:** Swiper.js (Sliders), AOS (Scroll Animations)
- **Database:** SQLite (Mặc định cho môi trường dev, có thể chuyển sang MySQL/PostgreSQL)

---

## 🚀 Hướng dẫn cài đặt

### Yêu cầu hệ thống

- PHP >= 8.2
- Composer
- Node.js & NPM (Dùng để build asset cho frontend nếu có tùy chỉnh sâu)

### Các bước cài đặt cục bộ (Local Development)

**Bước 1:** Clone repository về máy tính

```bash
git clone <your-repo-url>
cd la-hieu-fullstack
```

**Bước 2:** Cài đặt các dependencies qua Composer

```bash
composer install
```

**Bước 3:** Cấu hình biến môi trường

```bash
cp .env.example .env
php artisan key:generate
```

_Lưu ý: Mặc định database được thiết lập là `sqlite`. Đảm bảo tệp `database/database.sqlite` đã tồn tại (nếu chưa, hãy tạo thủ công)._

**Bước 4:** Chạy Migration để khởi tạo cơ sở dữ liệu

```bash
php artisan migrate
```

**Bước 5:** Tạo liên kết thư mục lưu trữ ảnh (Symlink)

```bash
php artisan storage:link
```

**Bước 6:** Tạo tài khoản quản trị viên (Super Admin)

```bash
php artisan make:filament-user
```

_(Nhập tên, email và mật khẩu. Sau khi đăng nhập, bạn có thể cấp quyền `super_admin` cho user này trong database)._

**Bước 7:** Khởi động server

```bash
php artisan serve
```

- Truy cập Frontend: `http://localhost:8000`
- Truy cập Admin Panel: `http://localhost:8000/admin`

---

## 📂 Cấu trúc thư mục cốt lõi

```text
la-hieu-fullstack/
├── app/
│   ├── Filament/         # Nơi chứa các Resources, Pages, Widgets của Admin Panel
│   ├── Models/           # Các Model của Eloquent
│   ├── Policies/         # Chính sách phân quyền truy cập
│   └── Providers/        # Service Providers (bao gồm AdminPanelProvider)
├── database/
│   └── migrations/       # Schema thiết kế CSDL hoàn chỉnh của toàn dự án
├── public/
│   ├── admin/            # CSS/JS phục vụ riêng cho giao diện Admin Filament
│   └── client/           # Thư mục chứa tài nguyên tĩnh: Fonts, Images tĩnh (static), Icons
├── resources/
│   └── views/
│       ├── admin/        # Custom views cho Admin (nếu có)
│       ├── client/       # Các trang Frontend (Home, About, Contact, v.v...)
│       └── components/   # Các Blade Components dùng chung (Header, Footer, Layout, Card...)
└── .agents/              # Hướng dẫn và cấu hình dành riêng cho AI LLMs/Agents
```

---

## 🤖 Ghi chú dành cho AI & LLM Agents

Dự án này sử dụng tiêu chuẩn khắt khe cho phát triển **FilamentPHP v5**.
Nếu sử dụng AI (Cursor, GitHub Copilot, Cline...) để hỗ trợ viết code, AI cần bắt buộc tuân thủ các nguyên tắc được định nghĩa trong file `.agents/skills/filamentphp-v5-skill/SKILL.md` và `.agents/AGENTS.md`.

- Tuyệt đối sử dụng `Schema $schema` thay vì `Form $form`.
- Tách file `*Form.php` và `*Table.php` riêng biệt thay vì gộp chung trong Resource.
- Sử dụng cú pháp `recordActions()` cho Tables.

---

## 📝 Giấy phép

Dự án được bảo lưu mọi quyền (All Rights Reserved). Phần giao diện UI/UX thuộc bản quyền thiết kế của team Là Hiếu. Vui lòng không sao chép nguyên trạng mục đích thương mại khi chưa có sự cho phép.
