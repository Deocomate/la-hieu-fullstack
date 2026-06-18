---
phase: 3
title: "Gallery Integration"
status: pending
priority: P1
effort: "5h"
dependencies: [2]
---

<!-- Updated: Validation Session 1 - show all images; defer home section -->

# Phase 3: Gallery Integration

## Overview

Gắn data contract và trigger buttons vào tất cả grid gallery partials. Đảm bảo dynamic re-render (Event Photos index) vẫn hoạt động qua event delegation.

## Requirements

### Functional
- Mỗi surface P1 mở lightbox với đúng album images và đúng index
- Grid layout/hover hiện tại **không đổi** (chỉ thêm button wrapper + data attrs)
- Event Photos index: sau `renderGallery()` click vẫn mở lightbox (delegation)

### Non-functional
- Không duplicate `data-gallery-images` JSON across pages unnecessarily
- `type="button"` triggers — không nested interactive elements

## Integration Map

### 3.1 `detail-gallery-grid.blade.php` (P1 — highest impact)

**Modify:** `resources/views/components/clients/shared/detail-gallery-grid.blade.php`

**Props change:**
```php
@props(['images' => null, 'galleryId' => 'gallery', 'altPrefix' => 'Gallery Image'])

@php
    $allImages = collect($images ?? $defaultImages)->filter()->values();

    if ($allImages->isEmpty()) {
        $allImages = collect($defaultImages);
    }

    $lightboxImages = \App\Support\GalleryImage::fromPaths($allImages, $altPrefix);
    $gridImages = $allImages; // validated: show ALL images, no pad/take(8)
    $galleryJson = json_encode($lightboxImages, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
@endphp

<section ...>
  <div data-gallery="{{ $galleryId }}"
       data-gallery-images="{{ $galleryJson }}"
       class="...">
    @foreach ($gridImages as $index => $image)
      <button type="button"
              data-gallery-index="{{ $index }}"
              class="gallery-trigger w-full ... (existing classes)">
        <img src="{{ $image }}" ... />
        <div class="absolute inset-0 ..."></div>
      </button>
    @endforeach
  </div>
</section>
```

**Validated:** Grid và lightbox dùng cùng full image list — không còn cap 8 ảnh.

**Detail pages pass galleryId:**
```blade
{{-- event-photos/detail.blade.php --}}
@include('components.clients.shared.detail-gallery-grid', [
    'images' => $album->media->pluck('file_url')->map(fn ($p) => \App\Support\ClientImage::url($p)),
    'galleryId' => 'event-' . $album->slug,
    'altPrefix' => $album->title,
])
```

### 3.2 `gallery-section.blade.php` (Event Photos index)

**Modify:** `resources/views/client/event-photos/partials/gallery-section.blade.php`

Wrapper:
```html
<div id="gallery-container"
     data-gallery="event-photos-active"
     data-gallery-images='...'
     class="...">
```

**PHP:** Thêm `lightbox_images` vào `$albumPayload`:
```php
'lightboxImages' => GalleryImage::fromMediaCollection($album->media, $album->title),
```

**Blade initial render:** Mỗi image item là `<button data-gallery-index="...">`.

**JS `renderGallery()` update:**
```javascript
function renderGallery(album) {
  galleryContainer.dataset.galleryImages = JSON.stringify(album.lightboxImages);
  galleryContainer.innerHTML = album.lightboxImages.map((img, index) => `
    <button type="button" data-gallery-index="${index}" class="gallery-trigger w-full mb-[10px] ...">
      <img src="${img.src}" alt="${img.alt}" ... />
      ...
    </button>
  `).join('');
}
```

**No extra listeners needed** — Phase 2 delegation handles clicks.

**Album switch:** Update `data-gallery-images` when `setActiveAlbum()` runs.

### 3.3 `fap-gallery-item.blade.php` (Faces & Places index)

**Modify:** `resources/views/client/faces-and-places/partials/fap-gallery-item.blade.php`

**Props from parent:**
```blade
{{-- fap-gallery-contain-section.blade.php --}}
@include('...fap-gallery-item', [
    'galleryId' => 'fap-' . $album->slug,
    'lightboxImages' => \App\Support\GalleryImage::fromMediaCollection($album->media, $album->title),
    ...
])
```

Wrap grid:
```html
<div data-gallery="{{ $galleryId }}"
     data-gallery-images='@json($lightboxImages)'>
  <!-- each of 9 image divs → button.gallery-trigger with data-gallery-index 0-8 -->
</div>
```

### 3.4 Home section — DEFERRED P2

`faces-and-places-section.blade.php` — **không làm trong v1** (validated). Ghi nhận trong backlog.

### Shared partial (optional refactor)

**Create:** `resources/views/components/clients/gallery/grid-trigger.blade.php`

```blade
@props(['src', 'alt', 'index', 'class' => ''])
<button type="button" data-gallery-index="{{ $index }}"
        class="gallery-trigger {{ $class }}">
    <img src="{{ $src }}" alt="{{ $alt }}" loading="lazy" class="..." />
    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 ..."></div>
</button>
```

## CSS additions

Add to `gallery-section` existing styles or global:

```css
.gallery-trigger {
  display: block;
  padding: 0;
  border: none;
  background: transparent;
  text-align: inherit;
  cursor: pointer;
}
.gallery-trigger:focus-visible {
  outline: 2px solid #C5AA82;
  outline-offset: 2px;
}
```

## Implementation Steps

1. Update `detail-gallery-grid` — bỏ pad/take(8), hiển thị tất cả ảnh
2. Update event-photos detail + faces detail includes with `galleryId`, `altPrefix`
3. Update `gallery-section` PHP payload + `renderGallery()` template
4. Update `fap-gallery-contain-section` + `fap-gallery-item`
5. Visual QA on all breakpoints (4 surfaces P1 only)

## Success Criteria

- [ ] Event Photos detail: click any grid image → lightbox with all album media
- [ ] F&P detail: same behavior
- [ ] Event Photos index: switch album → click image → correct album images
- [ ] F&P index: each album section has isolated gallery group
- [ ] Grid hover/scale animations preserved
- [ ] No layout shift from button wrapper (button is `display: block; width: 100%`)

## Risk Assessment

| Risk | Mitigation |
|------|------------|
| `@json()` in HTML attribute breaks quotes | Use `data-gallery-images='@json($x)'` with single quotes outer |
| 9 hardcoded slots in fap-gallery-item but album has 3 images | Pad only for grid display; lightbox JSON uses actual media only |
| Removing 8-image cap changes detail page length | Acceptable — albums should show all photos |
