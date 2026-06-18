---
phase: 2
title: "Fix Lightbox Fit"
status: pending
priority: P1
effort: "3h"
dependencies: [1]
---

# Phase 2: Fix Lightbox Fit

## Overview

Sửa `gallery-lightbox.js` để PhotoSwipe luôn dùng kích thước thật của ảnh, và tinh chỉnh `GalleryImage` fallback. Ảnh preview fit viewport (`initialZoomLevel: 'fit'`) **không méo**.

## Requirements

### Functional
- Preview ảnh giữ đúng aspect ratio gốc
- Ảnh phóng to tối đa trong vùng viewport (trừ padding + thumb strip)
- Slide đầu tiên dùng dimensions từ thumbnail grid nếu có
- Mọi slide (prev/next/thumb) đều correct sau load

### Non-functional
- Không thêm npm/vite dependency
- Giữ `zoom: false`, thumb strip, keyboard nav
- Minimal diff — chỉ sửa file cần thiết

## Architecture

### Primary fix — PhotoSwipe dimension correction

Hook vào lifecycle PhotoSwipe v5 để cập nhật dimensions sau khi `<img>` load:

```javascript
function applyNaturalDimensions(content, pswp) {
    const img = content.element;
    if (!img?.naturalWidth || !img?.naturalHeight) {
        return;
    }

    const { naturalWidth, naturalHeight } = img;

    if (content.width === naturalWidth && content.height === naturalHeight) {
        return;
    }

    content.width = naturalWidth;
    content.height = naturalHeight;
    pswp.refreshSlideContent(content.index);
}

// Trong openGallery(), sau khi tạo lightbox:
lightbox.on('contentLoad', (event) => {
    const { content } = event;

    if (content.type !== 'image') {
        return;
    }

    content.element.onload = () => {
        applyNaturalDimensions(content, lightbox.pswp);
        content.onLoaded();
    };

    // Fallback nếu ảnh cached (complete trước onload)
    if (content.element.complete && content.element.naturalWidth) {
        applyNaturalDimensions(content, lightbox.pswp);
    }
});
```

> **Note:** Verify exact PhotoSwipe v5 event API khi implement — có thể dùng `loadComplete` thay `contentLoad` nếu CDN bundle không fire `contentLoad` như docs. Mục tiêu: update dimensions + refresh slide.

### Secondary fix — trigger thumbnail dimensions

Khi click, đọc kích thước từ `<img>` trong trigger (đã load trên grid):

```javascript
function resolveStartDimensions(trigger, image) {
    const thumbImg = trigger.querySelector('img');

    if (thumbImg?.naturalWidth && thumbImg?.naturalHeight) {
        return {
            width: thumbImg.naturalWidth,
            height: thumbImg.naturalHeight,
        };
    }

    return {
        width: Number(image.width) || undefined,
        height: Number(image.height) || undefined,
    };
}
```

Pass vào `buildDataSource` cho `startIndex` item — giảm layout jump slide đầu.

### Tertiary fix — buildDataSource fallback

```javascript
function buildDataSource(images, startIndex, trigger) {
    return images.map((image, index) => {
        let width = Number(image.width) || 0;
        let height = Number(image.height) || 0;

        if (index === startIndex && trigger) {
            const resolved = resolveStartDimensions(trigger, image);
            width = resolved.width || width;
            height = resolved.height || height;
        }

        // PhotoSwipe cần placeholder — dùng 3:2 chỉ khi chưa biết; JS sẽ correct sau load
        return {
            src: image.src,
            width: width || 1600,
            height: height || 1067,
            alt: image.alt || '',
        };
    });
}
```

Placeholder tạm thời OK vì `contentLoad` sẽ correct ngay; tránh stretch kéo dài bằng cách refresh ngay khi `naturalWidth` available.

### Optional CSS safety net

Thêm vào `resources/views/components/clients/styles.blade.php` (chỉ nếu vẫn thấy stretch sau JS fix):

```css
.pswp__img {
    object-fit: contain;
}
```

PhotoSwipe thường scale bằng transform — CSS này là belt-and-suspenders. **Chỉ thêm nếu QA vẫn thấy méo.**

### Backend — GalleryImage.php (minor)

```php
// fromMedia: giữ logic hiện tại — dùng DB width/height khi có

// fromPaths: thay vì hardcode DEFAULT_WIDTH/HEIGHT
'width' => 0,
'height' => 0,
```

JS sẽ probe; 0 → buildDataSource dùng placeholder tạm.

## Related Code Files

- Modify: `public/client/assets/js/gallery-lightbox.js`
- Modify (optional): `app/Support/GalleryImage.php`
- Modify (optional): `resources/views/components/clients/styles.blade.php`

## Implementation Steps

1. Update `buildDataSource(images, startIndex, trigger)` signature
2. Update click handler — pass `trigger` vào `openGallery(images, startIndex, trigger)`
3. Add `resolveStartDimensions()` helper
4. Add PhotoSwipe `contentLoad` / `loadComplete` handler với `applyNaturalDimensions()`
5. Test portrait + landscape + square manually
6. (Optional) Update `GalleryImage::fromPaths` width/height → 0
7. (Optional) Add CSS `object-fit: contain` nếu cần

## Success Criteria

- [ ] Portrait ảnh: không bị kéo rộng; có letterbox trái/phải nếu cần
- [ ] Landscape ảnh: fit width, letterbox trên/dưới nếu cần
- [ ] Square ảnh: fit trong viewport vuông
- [ ] Chuyển slide → không méo trên bất kỳ ảnh nào
- [ ] Thumb strip + counter vẫn sync
- [ ] Không console errors từ PhotoSwipe

## Risk Assessment

| Risk | Mitigation |
|------|------------|
| `contentLoad` API khác giữa PhotoSwipe builds | Test với CDN version đang dùng (`photoswipe@5`); fallback `loadComplete` |
| Infinite refresh loop | Guard: chỉ refresh khi dimensions thực sự thay đổi |
|0| Flash/jump khi refresh | Trigger thumb dims giảm jump slide đầu; acceptable cho slide sau |
