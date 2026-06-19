---
phase: 1
title: "Research"
status: pending
priority: P1
effort: "2h"
dependencies: []
---

# Phase 1: Research

## Overview

Audit toàn bộ asset references, fallback routes, SEO data flow, và upload path conventions trước khi migration. Xác nhận không còn hidden dependency vào PHP static serving.

## Requirements

- Functional: Liệt kê đầy đủ file/path cần đổi `client/assets/` → `assets/`
- Functional: Map SEO fields per page type (index vs detail)
- Non-functional: Đếm số lần `ClientImage::url()` được gọi trong vòng lặp (gallery impact)
- Non-functional: Xác nhận deploy target (Nginx vs `artisan serve`)

## Architecture

### Asset reference inventory

Chạy các lệnh audit:

```powershell
# All client/assets references
rg "client/assets" --glob "!storage/framework/**" --glob "!plans/**" -c

# ClientImage usage sites
rg "ClientImage::url" resources/ app/ -l

# PHP fallback route tests
rg "fallback_image_routes|client/assets/\{" tests/ routes/

# Filament upload directories (already relative, no client/assets prefix)
rg "->directory\(" app/Filament/ -n
```

**Kết quả đã biết (baseline):**

| Category | Count (approx) | Key files |
|----------|----------------|-----------|
| Blade `asset('client/assets/...')` | ~40+ files | chrome header/footer, home sections, pagination |
| DB seeders/factories | 8 files | `PageSeeder`, `ArticleSeeder`, `EventAlbumSeeder`, ... |
| `ClientImage::url()` call sites | ~15 blade + `GalleryImage.php` | gallery, article list, home sections |
| Tests asserting old paths | 2 test methods | `FilamentResourceTest`, `ClientPageDataBindingTest` |
| JS asset reference | 1 | `gallery/lightbox.blade.php` |

### Storage layout audit

```
public/client/assets/
├── static/   ← design images (move → public/assets/static/)
├── fonts/    ← TTF files (move → public/assets/fonts/)
└── js/       ← gallery-lightbox.js (move → public/assets/js/)

storage/app/public/
├── client/assets/static/  ← legacy PNG duplicates (consolidate into public/assets/static/)
├── articles/              ← admin uploads (KEEP)
├── partners/              ← admin uploads (KEEP)
├── pages/                 ← admin uploads (KEEP)
└── ...
```

**Quyết định:** File trong `storage/app/public/client/assets/static/` là bản copy của design assets — sau migration, xóa thư mục `client/` trong storage (chỉ giữ admin upload paths).

### SEO data flow map

| Page | Controller | SEO source variable | Fields |
|------|------------|---------------------|--------|
| Home | `HomeController` | `$page` (key=home) | seo_title, seo_description, seo_image |
| About | `AboutController` | `$page` | same |
| Contact | `ContactController` | `$page` | same |
| Event Photos index | `EventPhotoController` | `$page` | same |
| Event Photos detail | `EventPhotoController::show` | `$album` | same |
| Faces & Places index/detail | `FacesAndPlacesController` | `$page` / `$album` | same |
| Photojournalism index | `PhotojournalismController` | `$page` | same |
| Photojournalism detail | `PhotojournalismController::show` | `$article` | same |
| Videography index/detail | `VideographyController` | `$page` / `$article` | same |

**Global fallback:** `Setting` keys `seo_default_image` (và có thể thêm `seo_default_title`, `seo_default_description` nếu chưa có).

### ClientImage call frequency (gallery pages)

Trang detail gallery render 20+ ảnh qua:
- `GalleryImage::fromMediaCollection()` → `ClientImage::url()` per media
- `faces-and-places/gallery-contain.blade.php` → `pluck('file_url')->map(fn => ClientImage::url())`

Với `file_exists()` hiện tại: **20+ sync disk I/O per page load** cho PNG paths. Sau refactor: **0 disk I/O**.

## Related Code Files

- Read: `routes/web.php` (lines 50–72)
- Read: `app/Support/ClientImage.php`
- Read: `app/Support/GalleryImage.php`
- Read: `resources/views/components/layouts/main-client.blade.php`
- Read: `app/Providers/AppServiceProvider.php`
- Read: `bootstrap/app.php` (admin middleware)
- Read: `app/Filament/Schemas/Components/SeoTab.php`
- Read: `tests/Feature/FilamentResourceTest.php` (fallback route tests)

## Implementation Steps

1. **Chạy audit commands** ở trên, lưu file count vào checklist
2. **Kiểm tra `public/storage` symlink** tồn tại: `Test-Path public/storage`
3. **Liệt kê file PNG chỉ có trong storage** (không có trong public) — quyết định copy sang `public/assets/static/`
4. **Review Nginx config** (nếu có) hoặc confirm `artisan serve` behavior cho static files
5. **Thiết kế `SeoMeta` interface** — dùng chung cho Page/Article/Album models (duck typing: 3 fields)
6. **Thiết kế View Composer SEO** — detect `$page` / `$article` / `$album` from view data; fallback to Settings
7. **WS-6 confirmed in scope** — spatie optimizer + backfill command; audit binary deps for Windows dev

## Success Criteria

- [ ] Complete inventory of `client/assets` references documented
- [ ] SEO variable mapping confirmed per controller/view
- [ ] Storage vs public asset duplication resolved (migration plan for legacy PNGs)
- [ ] Decision recorded: WS-6 image optimization IN scope (upload + backfill)
- [ ] No unknown consumers of PHP fallback routes beyond tests

## Risk Assessment

- **Missed reference** after global replace → broken image. Mitigation: `rg "client/assets"` must return 0 after implement.
- **restructure-components plan in flight** → double-edit same blades. Mitigation: coordinate timing or run global replace last.
