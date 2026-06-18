---
phase: 3
title: "Tests & QA"
status: pending
priority: P1
effort: "1.5h"
dependencies: [2]
---

# Phase 3: Tests & QA

## Overview

Cập nhật unit tests cho thay đổi `GalleryImage` (nếu có), chạy regression suite, và manual QA trên 4 gallery surfaces với nhiều tỷ lệ ảnh.

## Requirements

### Functional
- Pest tests pass
- Manual QA checklist hoàn thành trên desktop + mobile viewport

### Non-functional
- Không thêm E2E framework mới (project không có Playwright cho client)

## Architecture

Test layers:
1. **Unit** — `GalleryImageTest` (fallback dimensions change)
2. **Feature** — `ClientPageDataBindingTest::test_gallery_pages_render_lightbox_markup` (markup không đổi)
3. **Manual** — browser QA với DevTools dimension check

## Related Code Files

- Modify (if needed): `tests/Unit/GalleryImageTest.php`
- Run: `tests/Feature/ClientPageDataBindingTest.php`

## Implementation Steps

1. **Update unit test** nếu `fromPaths` đổi fallback:
   ```php
   // test_maps_string_paths_with_client_image_urls
   $this->assertSame(0, $result[0]['width']);
   $this->assertSame(0, $result[0]['height']);
   ```
2. **Run tests:**
   ```powershell
   php artisan test --filter=GalleryImage
   php artisan test --filter=ClientPageDataBinding
   ```
3. **Manual QA checklist** (desktop Chrome + mobile viewport 390px):

| Page | Action | Expected |
|------|--------|----------|
| Event Photos detail | Click portrait image | No stretch; letterbox sides |
| Event Photos detail | Click landscape image | No stretch; fits width |
| Event Photos index | Switch album → click image | Correct ratio |
| F&P detail | Click square-ish image | No stretch |
| F&P index | Click image in masonry grid | No stretch |
| Any | Arrow keys / thumb click | All slides correct ratio |
| Any | Esc close | Thumb strip hides |

4. **DevTools verification** (1 ảnh portrait, 1 landscape):
   ```javascript
   const slide = document.querySelector('.pswp')?.__pswp?.currSlide;
   const img = slide?.content?.element;
   console.assert(slide.width === img.naturalWidth, 'width mismatch');
   console.assert(slide.height === img.naturalHeight, 'height mismatch');
   ```
5. **Regression:** Grid layout, hover scale, album switch (event photos index) không bị ảnh hưởng

## Success Criteria

- [ ] `php artisan test --filter=GalleryImage` pass
- [ ] `php artisan test --filter=ClientPageDataBinding` pass
- [ ] Manual QA checklist 100% pass
- [ ] DevTools assert: slide dimensions === natural dimensions
- [ ] No visual regression on grid thumbnails (still `object-cover`)

## Risk Assessment

| Risk | Mitigation |
|------|------------|
| JS behavior không test được bằng Pest | Manual QA + DevTools assert bắt buộc |
| Staging thiếu ảnh đa dạng | Factory media với width/height khác nhau |
