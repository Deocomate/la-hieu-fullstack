---
phase: 1
title: "Research & Architecture"
status: pending
priority: P1
effort: "2h"
dependencies: []
---

# Phase 1: Research & Architecture

## Overview

Khảo sát toàn bộ grid gallery hiện có, chốt kiến trúc lightbox dùng chung, data contract giữa backend và frontend.

## Requirements

### Functional
- Xác định đầy đủ các blade partials cần tích hợp
- Định nghĩa JSON schema cho gallery images
- Quyết định singleton vs per-page lightbox

### Non-functional
- Không thêm npm/vite build step
- Tương thích Tailwind CDN + vanilla JS pattern hiện tại
- WCAG: focus trap, keyboard nav, `aria-label` trên controls

## Current State Inventory

### 1. `detail-gallery-grid.blade.php` (SHARED)

**Dùng tại:** Event Photos detail, Faces & Places detail

```php
// Hiện tại: cắt/pad cứng 8 ảnh
$gridImages = $gridImages->pad(8, $gridImages->first())->take(8);
```

- Mobile: masonry 2 cột
- Desktop: layout 2 hàng custom flex ratios
- Mỗi ảnh: `cursor-pointer`, hover overlay — **không có click handler**

### 2. `gallery-section.blade.php` (Event Photos index)

- Sidebar album nav + masonry grid
- `$albumPayload` JSON đã có `images[]` per album
- `renderGallery()` rebuild DOM qua `innerHTML` — **cần delegation**

### 3. `fap-gallery-item.blade.php` (Faces & Places index)

- 9 ảnh/album, layout 4 cột phức tạp
- Pad 9 ảnh nếu thiếu
- Mỗi album là gallery group riêng (`data-gallery` per album slug)

### 4. `faces-and-places-section.blade.php` (Home) — P2

- Flat list ảnh từ nhiều album
- 1 gallery group duy nhất `home-faces-places`

### Không thuộc grid gallery

| File | Lý do loại |
|------|------------|
| `photojournalism/detail-hero-slider-section.blade.php` | Swiper carousel |
| `videography/detail-hero-slider-section.blade.php` | Video hero |
| `home/photojournalism-section.blade.php` | Link cards → detail page |

## Architecture

### Component layering

```
main-client.blade.php
  └── @include gallery/lightbox (once, hidden)
  └── @stack scripts
        └── gallery-lightbox.js (global init)

Per gallery partial:
  └── [data-gallery] wrapper
        └── button.gallery-trigger[data-gallery-index]
              └── img
```

### GalleryImage helper (backend)

**Create:** `app/Support/GalleryImage.php`

```php
final class GalleryImage
{
    /** @return list<array{src: string, thumb: string, alt: string, width: ?int, height: ?int}> */
    public static function fromPaths(
        iterable $paths,
        string $altPrefix = 'Gallery Image',
    ): array;

    /** @return list<array{...}> */
    public static function fromMediaCollection(
        Collection $media,
        string $altPrefix = 'Gallery Image',
    ): array;
}
```

- `src` / `thumb`: dùng `ClientImage::url()` — phase 1 có thể cùng URL
- Sort theo `media.priority` ascending
- `alt`: `"{$altPrefix} {$index}"` hoặc từ `custom_properties['alt']` nếu có sau này

### JSON schema

```json
{
  "src": "https://.../image.jpg",
  "thumb": "https://.../image.jpg",
  "alt": "Event Album Image 3",
  "width": 1920,
  "height": 1280
}
```

### Lightbox UI wireframe

```
┌─────────────────────────────────────────────┐
│  [X]                                        │
│                                             │
│  [<]      MAIN IMAGE (object-contain)   [>] │
│                                             │
│  ┌────┬────┬────┬────┬────┬────┐           │
│  │thumb│thumb│thumb│thumb│...  │  scroll →  │
│  └────┴────┴────┴────┴────┴────┘           │
│           3 / 12                            │
└─────────────────────────────────────────────┘
```

## Related Code Files

- Read: `resources/views/components/clients/shared/detail-gallery-grid.blade.php`
- Read: `resources/views/client/event-photos/partials/gallery-section.blade.php`
- Read: `resources/views/client/faces-and-places/partials/fap-gallery-item.blade.php`
- Read: `app/Support/ClientImage.php`
- Read: `app/Models/Media.php`

## Implementation Steps

1. Confirm scope với stakeholder: home F&P section có trong v1 không (default: P2)
2. Document data contract (`data-gallery`, `data-gallery-images`, `data-gallery-index`)
3. Sketch `GalleryImage` helper API
4. Chốt PhotoSwipe v5 CDN + custom thumb strip (validated)
5. List breaking changes: **bỏ** `pad(8)->take(8)` — hiển thị tất cả ảnh trong grid (validated)

## Success Criteria

- [ ] Inventory 4+ gallery surfaces documented với file paths
- [ ] Data contract JSON schema finalized
- [ ] Architecture diagram reviewed
- [ ] Out-of-scope list agreed (swipers, link cards)

## Risk Assessment

| Risk | Impact | Mitigation |
|------|--------|------------|
| Grid hiển thị 8 ảnh nhưng album có 20 | User chỉ xem được 8 | Tách `lightboxImages` (full) khỏi `displayImages` (grid) |
| Inline JSON quá lớn | HTML payload | Chỉ embed per gallery group, không global all albums |
