---
phase: 1
title: "Research & Audit"
status: pending
priority: P1
effort: "1h"
dependencies: []
---

# Phase 1: Research & Audit

## Overview

Xác nhận root cause trên tất cả gallery surfaces, audit chất lượng dữ liệu `width`/`height` trong DB, và ghi nhận tỷ lệ ảnh thực tế (portrait vs landscape) để validate fix.

## Requirements

- Functional: Liệt kê đầy đủ file/component liên quan lightbox
- Non-functional: Không thay đổi code trong phase này — chỉ audit

## Architecture

Audit flow:
1. Mở DevTools → click ảnh gallery → inspect PhotoSwipe slide `width`/`height` vs `img.naturalWidth/Height`
2. So sánh `data-gallery-images` JSON với kích thước thật
3. Query sample Media records xem `width`/`height` null rate

## Related Code Files

- Read: `public/client/assets/js/gallery-lightbox.js`
- Read: `app/Support/GalleryImage.php`
- Read: `app/Support/MediaProcessor.php`
- Read: `resources/views/components/clients/shared/detail-gallery-grid.blade.php`
- Read: `resources/views/client/event-photos/partials/gallery-section.blade.php`
- Read: `resources/views/client/faces-and-places/partials/fap-gallery-item.blade.php`

## Implementation Steps

1. **Reproduce bug** trên ít nhất 2 trang:
   - `/event-photos/{slug}` — album có ảnh portrait
   - `/faces-and-places/{slug}` hoặc index gallery
2. **DevTools check** khi lightbox mở:
   ```javascript
   // Console
   const pswp = document.querySelector('.pswp')?.__pswp || window.activeLightbox?.pswp;
   const slide = pswp?.currSlide;
   console.log({ slideW: slide?.width, slideH: slide?.height, naturalW: slide?.content?.element?.naturalWidth, naturalH: slide?.content?.element?.naturalHeight });
   ```
3. **Inspect JSON payload** — `dataset.galleryImages` trên `[data-gallery]`:
   - Ghi nhận `width`/`height` có khớp ảnh thật không
4. **DB audit** (local/staging):
   ```sql
   SELECT COUNT(*) AS total,
          SUM(CASE WHEN width IS NULL OR height IS NULL OR width = 0 OR height = 0 THEN 1 ELSE 0 END) AS missing_dims
   FROM media WHERE mime_type LIKE 'image/%';
   ```
5. **Phân loại surfaces** — xác nhận tất cả dùng chung `gallery-lightbox.js` (không có lightbox implementation riêng)
6. **Document findings** trong PR notes hoặc comment phase 2

## Expected Findings

| Finding | Likely? | Action in Phase 2 |
|---------|---------|-------------------|
| `slide.width/height` ≠ `naturalWidth/Height` | High | JS `contentLoad` fix |
| Media null dimensions | Medium | JS fix covers; optional backfill P2 |
| `fromPaths` always 1920×1280 | High | Remove hardcoded fallback |
| PhotoSwipe config OK (`fit`) | High | No change needed |

## Success Criteria

- [ ] Bug reproduced và root cause xác nhận (wrong dimensions → stretch)
- [ ] Danh sách 4 surfaces verified
- [ ] DB null-dimension rate documented (even if 0% on dev)
- [ ] Không phát hiện lightbox implementation ngoài `gallery-lightbox.js`

## Risk Assessment

| Risk | Mitigation |
|------|------------|
| Dev env thiếu ảnh portrait | Dùng factory tạo media 800×1200 để test |
| Không có DB local | Audit qua code path + browser only |
