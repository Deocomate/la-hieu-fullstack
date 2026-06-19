---
phase: 2
title: "Implement"
status: pending
priority: P1
effort: "4-5h"
dependencies: [1]
---

# Phase 2: Implement

## Overview

Di chuyển file theo migration map, cập nhật mọi reference, chuẩn hóa `<x-clients.*>` ở page level, gom 13 page partials vào `clients/pages/`, xóa thư mục `shared/` và `client/**/partials/`.

<!-- Updated: Validation Session 1 - chrome all-x, pages/ scope, image-slot rename -->

## Requirements

- Functional: Mọi trang client render giống trước refactor (pixel-parity)
- Non-functional: Một domain một folder; không file orphan ở root `clients/` (trừ subfolders)

## Architecture

Thực hiện theo thứ tự **bottom-up** (leaf components trước, layout sau) để tránh broken intermediate state:

1. `ui/pagination` → `article/card` → `gallery/image-slot` → `gallery/detail-grid`
2. `article/list`, `article/detail-content`
3. `sections/follow`
4. `chrome/*`
5. `layouts/main-client`
6. Page call sites

## Related Code Files

### Create / Move (git mv)

```
git mv resources/views/components/clients/pagination.blade.php resources/views/components/clients/ui/pagination.blade.php
git mv resources/views/components/clients/follow-section.blade.php resources/views/components/clients/sections/follow.blade.php
git mv resources/views/components/clients/header.blade.php resources/views/components/clients/chrome/header.blade.php
git mv resources/views/components/clients/footer.blade.php resources/views/components/clients/chrome/footer.blade.php
git mv resources/views/components/clients/styles.blade.php resources/views/components/clients/chrome/styles.blade.php
git mv resources/views/components/clients/scripts.blade.php resources/views/components/clients/chrome/scripts.blade.php
git mv resources/views/components/clients/shared/article-card.blade.php resources/views/components/clients/article/card.blade.php
git mv resources/views/components/clients/shared/article-list.blade.php resources/views/components/clients/article/list.blade.php
git mv resources/views/components/clients/shared/detail-content-blocks.blade.php resources/views/components/clients/article/detail-content.blade.php
git mv resources/views/components/clients/shared/detail-gallery-grid.blade.php resources/views/components/clients/gallery/detail-grid.blade.php
git mv resources/views/components/clients/gallery/fap-gallery-image-slot.blade.php resources/views/components/clients/gallery/image-slot.blade.php
```

### git mv — Page partials (batch 2)

```
git mv resources/views/client/home/partials/hero-section.blade.php resources/views/components/clients/pages/home/hero.blade.php
git mv resources/views/client/home/partials/event-photography-section.blade.php resources/views/components/clients/pages/home/event-photography.blade.php
git mv resources/views/client/home/partials/photojournalism-section.blade.php resources/views/components/clients/pages/home/photojournalism.blade.php
git mv resources/views/client/home/partials/videography-section.blade.php resources/views/components/clients/pages/home/videography.blade.php
git mv resources/views/client/home/partials/faces-and-places-section.blade.php resources/views/components/clients/pages/home/faces-and-places.blade.php
git mv resources/views/client/home/partials/partners-section.blade.php resources/views/components/clients/pages/home/partners.blade.php
git mv resources/views/client/about/partials/about-section.blade.php resources/views/components/clients/pages/about/main.blade.php
git mv resources/views/client/contact/partials/contact-main-section.blade.php resources/views/components/clients/pages/contact/main.blade.php
git mv resources/views/client/event-photos/partials/gallery-section.blade.php resources/views/components/clients/pages/event-photos/gallery.blade.php
git mv resources/views/client/faces-and-places/partials/fap-gallery-contain-section.blade.php resources/views/components/clients/pages/faces-and-places/gallery-contain.blade.php
git mv resources/views/client/faces-and-places/partials/fap-gallery-item.blade.php resources/views/components/clients/pages/faces-and-places/gallery-item.blade.php
git mv resources/views/client/photojournalism/partials/detail-hero-slider-section.blade.php resources/views/components/clients/pages/photojournalism/detail-hero-slider.blade.php
git mv resources/views/client/videography/partials/detail-hero-slider-section.blade.php resources/views/components/clients/pages/videography/detail-hero-slider.blade.php
```

### Modify — Page index/detail views

| File | New includes |
|------|--------------|
| `client/home/index.blade.php` | 6× `<x-clients.pages.home.*>` + follow |
| `client/about/index.blade.php` | `<x-clients.pages.about.main />` |
| `client/contact/index.blade.php` | `<x-clients.pages.contact.main />` |
| `client/event-photos/index.blade.php` | `<x-clients.pages.event-photos.gallery />` |
| `client/faces-and-places/index.blade.php` | `<x-clients.pages.faces-and-places.gallery-contain />` |
| `client/photojournalism/detail.blade.php` | `<x-clients.pages.photojournalism.detail-hero-slider />` |
| `client/videography/detail.blade.php` | `<x-clients.pages.videography.detail-hero-slider />` |

### Modify — gallery-contain internal

```blade
{{-- was @include('client.faces-and-places.partials.fap-gallery-item') --}}
<x-clients.pages.faces-and-places.gallery-item ... />
```

### Delete (after move)

- `resources/views/components/clients/shared/` (empty dir)

### Modify — AppServiceProvider

```php
View::composer('components.clients.sections.follow', function ($view): void { ... });

View::composer([
    'components.clients.chrome.footer',
    'client.contact.partials.contact-main-section',
], function ($view): void { ... });
```

### Modify — layouts/main-client.blade.php

```blade
<x-clients.chrome.styles />
...
<x-clients.chrome.header />
...
<x-clients.chrome.footer />
<x-clients.gallery.lightbox />
<x-clients.chrome.scripts />
```

### Modify — Internal component references

**article/list.blade.php:**
```blade
<x-clients.article.card ... />
{{ $list->links('components.clients.ui.pagination') }}
```

**gallery/detail-grid.blade.php:**
```blade
<x-clients.gallery.grid-trigger ... />
```

**hero/*.blade.php** — cập nhật `@include('components.clients.hero.partials.bg-text')` (path không đổi).

### Modify — Page call sites (pattern)

**Trước:**
```blade
@include('components.clients.shared.article-list', ['cardLayout' => $cardLayout ?? 'zigzag'])
@include('components.clients.follow-section')
```

**Sau:**
```blade
<x-clients.article.list :card-layout="$cardLayout ?? 'zigzag'" />
<x-clients.sections.follow />
```

**Detail gallery (event-photos, faces-and-places):**
```blade
<x-clients.gallery.detail-grid
    :lightbox-images="\App\Support\GalleryImage::fromMediaCollection($album->media, $album->title)"
    :gallery-id="'event-' . $album->slug"
    :alt-prefix="$album->title"
/>
```

**fap-gallery-item.blade.php:**
```blade
<x-clients.gallery.image-slot ... />
```

- `resources/views/client/**/partials/` (empty dirs)

### Files to update (checklist)

| File | Changes |
|------|---------|
| `components/layouts/main-client.blade.php` | chrome + lightbox paths |
| `components/clients/article/list.blade.php` | card tag, pagination path |
| `components/clients/gallery/detail-grid.blade.php` | (path only if internal refs) |
| `client/photojournalism/index.blade.php` | article.list, sections.follow |
| `client/videography/index.blade.php` | idem |
| `client/event-photos/index.blade.php` | sections.follow |
| `client/faces-and-places/index.blade.php` | idem |
| `client/photojournalism/detail.blade.php` | detail-content, follow |
| `client/videography/detail.blade.php` | idem |
| `client/event-photos/detail.blade.php` | detail-grid, follow |
| `client/faces-and-places/detail.blade.php` | idem |
| `client/home/index.blade.php` | 6 page sections + follow |
| `client/about/index.blade.php` | about.main, follow |
| `client/contact/index.blade.php` | contact.main, follow |
| `client/event-photos/index.blade.php` | event-photos.gallery, follow |
| `client/faces-and-places/index.blade.php` | gallery-contain, follow |
| `client/photojournalism/detail.blade.php` | detail-hero-slider, detail-content, follow |
| `client/videography/detail.blade.php` | detail-hero-slider, detail-content, follow |
| `components/clients/pages/faces-and-places/gallery-contain.blade.php` | gallery-item tag |
| `components/clients/pages/faces-and-places/gallery-item.blade.php` | image-slot rename |
| `app/Providers/AppServiceProvider.php` | view composer paths |

## Implementation Steps

1. `mkdir` các folder mới: `chrome`, `article`, `sections`, `ui`, `pages/{home,about,contact,event-photos,faces-and-places,photojournalism,videography}`.
2. `git mv` component files theo map (batch 1).
3. `git mv` 13 partials → `clients/pages/**` (batch 2) — đổi tên file theo bảng phase 1.
4. Cập nhật internal cross-references trong components (gallery-item, gallery-contain, article/list).
5. Cập nhật `AppServiceProvider`:
   ```php
   View::composer('components.clients.sections.follow', ...);
   View::composer([
       'components.clients.chrome.footer',
       'components.clients.pages.contact.main',
   ], ...);
   ```
6. Cập nhật `main-client.blade.php` — **100% `<x-clients.chrome.*>`**:
   ```blade
   <x-clients.chrome.styles />
   <x-clients.chrome.header />
   <x-clients.chrome.footer />
   <x-clients.gallery.lightbox />
   <x-clients.chrome.scripts />
   ```
7. Cập nhật page views — ví dụ `home/index.blade.php`:
   ```blade
   <x-clients.pages.home.hero />
   <x-clients.pages.home.event-photography />
   ...
   <x-clients.sections.follow />
   ```
8. `rg "client\.(home|about|contact|event-photos|faces-and-places|photojournalism|videography)\.partials" resources/` → 0
9. `rg "shared/|follow-section|fap-gallery|components\.clients\.(header|footer|pagination)" resources/` → 0
10. `php artisan view:clear`
11. Xóa folder `shared/` và `client/**/partials/` nếu trống

## Success Criteria

- [ ] Cây thư mục khớp target architecture trong `plan.md`
- [ ] Không còn file ở `clients/` root (chỉ subfolders)
- [ ] Không còn `shared/` folder
- [ ] Grep sạch path cũ
- [ ] View composers trỏ path mới
- [ ] Không còn `client/**/partials/` folder
- [ ] `main-client` dùng 100% `<x-clients.chrome.*>`

## Risk Assessment

- **Prop naming `@include` → `<x-*>`:** Array keys `cardLayout` → `:card-layout` — verify Blade `@props` trong `article/list` dùng `cardLayout` (camelCase trong @props vẫn nhận kebab).
- **detail-gallery-grid props:** Đảm bảo `lightboxImages`, `galleryId`, `altPrefix` map đúng khi chuyển sang attribute syntax.
- **Mitigation:** Smoke test từng page type sau migrate.
