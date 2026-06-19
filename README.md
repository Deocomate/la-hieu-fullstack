# 📸 La Hieu Photography — Fullstack Portfolio

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/FilamentPHP-v5-F59E0B?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)

Website portfolio cho nhiếp ảnh gia **Là Hiếu**: frontend Blade + Tailwind CDN, CMS Filament v5, tối ưu cho gallery ảnh lớn.

---

## Tính năng

### Client

- Typography: Be Vietnam, Oswald, Archivo
- AOS, Swiper.js, PhotoSwipe lightbox
- Trang: Home, About, Contact, Event Photos, Faces & Places, Photojournalism, Videography
- SEO meta (title, description, Open Graph) từ DB qua View Composer
- Lazy-loaded images; static assets served từ `public/` (không qua PHP)

### Admin (Filament v5)

- CRUD: albums, articles, partners, social feeds, pages, settings
- RBAC: Super Admin / Admin
- Upload ảnh → `storage/app/public`, optimize tự động trên `Media`

---

## Tech stack

| Layer | Stack |
|-------|--------|
| Backend | Laravel 12, PHP ≥ 8.2 |
| Admin | Filament v5, Livewire v4 |
| Frontend | Blade, Tailwind CDN, Alpine.js |
| UI libs | Swiper, AOS, PhotoSwipe |
| DB | SQLite (dev), MySQL/PostgreSQL (prod) |
| Images | `spatie/laravel-image-optimizer` |

**Không dùng Vite/npm** — xem [`.agents/rules/do-not-use-vite.md`](.agents/rules/do-not-use-vite.md).

---

## Cài đặt (local)

**Yêu cầu:** PHP ≥ 8.2, Composer, extension GD (khuyến nghị cho WebP).

```bash
git clone <your-repo-url>
cd la-hieu-fullstack
composer install
cp .env.example .env
php artisan key:generate
```

Tạo SQLite nếu chưa có: `touch database/database.sqlite` (hoặc cấu hình MySQL trong `.env`).

```bash
php artisan migrate
php artisan storage:link
php artisan db:seed          # optional: demo content
php artisan make:filament-user
php artisan serve
```

| URL | Mô tả |
|-----|--------|
| http://localhost:8000 | Frontend |
| http://localhost:8000/admin | Filament admin |

---

## Artisan commands (bảo trì)

```bash
# Migrate DB paths cũ client/assets/ → assets/ (một lần sau upgrade)
php artisan assets:migrate-paths --dry-run
php artisan assets:migrate-paths

# Optimize ảnh đã upload
php artisan images:optimize-existing --dry-run
php artisan images:optimize-existing
```

---

## Cấu trúc thư mục

```text
la-hieu-fullstack/
├── app/
│   ├── Filament/              # Admin resources, forms, tables
│   ├── Http/Controllers/Client/
│   ├── Support/               # ClientImage, Seo, GalleryImage, MediaProcessor
│   ├── Services/              # ImageOptimizer
│   └── Providers/             # AppServiceProvider, AdminPanelProvider
├── public/
│   └── assets/                # Static theme: static/, fonts/, js/
├── resources/views/
│   ├── client/                # Page shells (index + detail)
│   └── components/
│       ├── layouts/main-client.blade.php
│       └── clients/           # chrome, hero, article, gallery, pages, ui, sections
├── routes/
│   ├── web.php                # Explicit client routes only
│   └── admin.php              # Custom /admin-custom routes (extension point)
├── docs/
│   ├── assets-and-performance.md
│   └── frontend.md
└── .agents/                   # AI agent rules & Filament v5 skill
```

---

## Tài liệu chi tiết

- [Assets & performance](docs/assets-and-performance.md) — paths, `ClientImage`, storage, image optimization
- [Frontend components](docs/frontend.md) — layout, naming, pagination

---

## AI / LLM agents

Tuân thủ:

- [`.agents/skills/filamentphp-v5-skill/SKILL.md`](.agents/skills/filamentphp-v5-skill/SKILL.md)
- [`.agents/rules/coding-guidelines.md`](.agents/rules/coding-guidelines.md)
- Filament v5: `Schema $schema`, tách `*Form.php` / `*Table.php`, `recordActions()` trên tables

---

## Tests

```bash
php artisan test
```

---

## Giấy phép

All Rights Reserved. UI/UX thuộc bản quyền team Là Hiếu.
