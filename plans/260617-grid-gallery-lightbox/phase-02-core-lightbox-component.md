---
phase: 2
title: "Core Lightbox Component"
status: pending
priority: P1
effort: "6h"
dependencies: [1]
---

# Phase 2: Core Lightbox Component

<!-- Updated: Validation Session 1 - PhotoSwipe v5 CDN thay custom JS; fit viewport only -->

## Overview

Xây dựng lightbox singleton dùng **PhotoSwipe v5 (CDN)** cho main viewer + **custom thumbnail strip** Tailwind/vanilla JS bên dưới. v1: fit viewport (`object-contain`), không pinch-zoom.

## Requirements

### Functional
- Mở PhotoSwipe tại index ảnh được click
- Chuyển ảnh: PhotoSwipe prev/next, thumb click, keyboard arrows
- Custom thumb strip sync với PhotoSwipe `change` event
- Counter `current / total` dưới main image
- Thumb strip auto-scroll để active thumb visible

### Non-functional
- CDN load (không npm/vite) — tuân `.agents/rules/do-not-use-vite.md`
- `prefers-reduced-motion`: giảm animation PhotoSwipe
- Mobile swipe native từ PhotoSwipe

## Architecture

### Files to Create

| File | Purpose |
|------|---------|
| `resources/views/components/clients/gallery/lightbox.blade.php` | PhotoSwipe root + thumb strip container |
| `public/client/assets/js/gallery-lightbox.js` | PhotoSwipe init + thumb strip controller |
| `app/Support/GalleryImage.php` | Normalize image payloads |

### Files to Modify

| File | Change |
|------|--------|
| `resources/views/components/layouts/main-client.blade.php` | `@include` lightbox once |
| `resources/views/components/clients/scripts.blade.php` | Load PhotoSwipe CDN + `gallery-lightbox.js` |

## PhotoSwipe Integration

### CDN assets

```blade
@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5/dist/photoswipe.css" />
@endpush

@push('scripts')
  <script type="module">
    import PhotoSwipeLightbox from 'https://cdn.jsdelivr.net/npm/photoswipe@5/dist/photoswipe-lightbox.esm.min.js';
    import PhotoSwipe from 'https://cdn.jsdelivr.net/npm/photoswipe@5/dist/photoswipe.esm.min.js';
    // hoặc bundle UMD nếu cần tương thích non-module
  </script>
@endpush
```

> **Note:** Project hiện dùng script thường (không ES modules). Có thể dùng PhotoSwipe UMD bundle hoặc `type="module"` riêng cho gallery script — chọn approach ít đụng nhất vào `scripts.blade.php`.

### DataSource API

```javascript
// gallery-lightbox.js
class GalleryLightbox {
  static open(images, startIndex = 0) {
    // images: [{ src, width, height, alt }]
    const dataSource = images.map(img => ({
      src: img.src,
      width: img.width || 1920,
      height: img.height || 1280,
      alt: img.alt,
    }));

    const lightbox = new PhotoSwipeLightbox({
      dataSource,
      pswpModule: PhotoSwipe,
      index: startIndex,
      bgOpacity: 0.95,
      padding: { top: 60, bottom: 120, left: 20, right: 20 }, // chừa chỗ thumb strip
      showHideAnimationType: 'fade',
    });

    lightbox.on('change', () => this.syncThumbs(lightbox));
    lightbox.init();
    lightbox.loadAndOpen(startIndex);
  }
}
```

### Custom thumbnail strip

Render bên ngoài PhotoSwipe UI, fixed bottom:

```html
<div id="gallery-thumb-strip" class="fixed bottom-0 left-0 right-0 z-[210] hidden ...">
  <div id="gallery-thumb-scroll" class="flex gap-2 overflow-x-auto justify-center px-4 py-3">
    <!-- buttons injected -->
  </div>
  <p id="gallery-counter" class="text-white/70 text-center text-sm pb-2">1 / 12</p>
</div>
```

Thumb button active: `border-[#C5AA82]`. Click thumb → `lightbox.pswp.goTo(index)`.

### Event delegation (unchanged from plan)

```javascript
document.addEventListener('click', (e) => {
  const trigger = e.target.closest('[data-gallery-index]');
  if (!trigger) return;
  const gallery = trigger.closest('[data-gallery]');
  const images = JSON.parse(gallery.dataset.galleryImages);
  GalleryLightbox.open(images, Number(trigger.dataset.galleryIndex));
});
```

## GalleryImage Helper

```php
// app/Support/GalleryImage.php — unchanged API
// width/height từ Media model quan trọng cho PhotoSwipe layout
```

## Implementation Steps

1. Create `GalleryImage.php` — include `width`, `height` from Media
2. Create `lightbox.blade.php` — PhotoSwipe mount point + thumb strip HTML
3. Implement `gallery-lightbox.js`:
   - PhotoSwipe lightbox wrapper
   - Thumb strip render/sync
   - Show/hide thumb strip on open/close
   - Delegated click handler
4. Wire CDN + script vào layout
5. Smoke test với hardcoded gallery trên 1 page

## Success Criteria

- [ ] PhotoSwipe opens at correct index
- [ ] Main image fits viewport (no pinch zoom v1)
- [ ] Thumb strip syncs on navigate
- [ ] Keyboard arrows + Esc work (PhotoSwipe native)
- [ ] Thumb strip hidden when lightbox closed
- [ ] `GalleryImage::fromMediaCollection()` returns width/height

## Risk Assessment

| Risk | Mitigation |
|------|------------|
| ES module vs UMD conflict | Test PhotoSwipe UMD bundle first |
| Missing width/height → layout jump | Default 1920×1280; prefer DB values |
| Thumb strip z-index under PhotoSwipe | z-[210] above PhotoSwipe default z-index |
