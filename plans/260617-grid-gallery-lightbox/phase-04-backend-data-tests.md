---
phase: 4
title: "Backend Data & Tests"
status: pending
priority: P1
effort: "2h"
dependencies: [2, 3]
---

# Phase 4: Backend Data & Tests

<!-- Updated: Validation Session 1 - controller names fixed; orderBy already exists -->

## Overview

Hoàn thiện `GalleryImage` helper, viết Pest tests. Controllers **đã** eager-load media với `orderBy('priority')` — không cần sửa query.

## Requirements

### Functional
- `GalleryImage` helper covered by unit tests (include width/height for PhotoSwipe)
- Feature tests assert `data-gallery` + `gallery-trigger` on P1 pages
- Album detail hiển thị **tất cả** media (không cap 8)

### Non-functional
- Tests dùng `RefreshDatabase` + factories hiện có
- Không test PhotoSwipe JS trong Pest

## Backend State (verified)

Controllers đã đúng:

| Controller | File | Media eager load |
|------------|------|------------------|
| `EventPhotoController` | `app/Http/Controllers/Client/EventPhotoController.php` | `orderBy('priority')` ✓ |
| `FacesAndPlacesController` | `app/Http/Controllers/Client/FacesAndPlacesController.php` | `orderBy('priority')` ✓ |

**Không cần** thay đổi controller queries trong v1 — chỉ thêm `GalleryImage` helper usage trong Blade.

## Test Plan

### Unit: `tests/Unit/GalleryImageTest.php`

```php
it('maps media collection to lightbox payload sorted by priority', function () {
    $album = EventAlbum::factory()->create();
    $album->media()->createMany([
        ['file_url' => 'b.jpg', 'priority' => 2, 'width' => 800, 'height' => 600, ...],
        ['file_url' => 'a.jpg', 'priority' => 1, 'width' => 1920, 'height' => 1080, ...],
    ]);

    $result = GalleryImage::fromMediaCollection($album->media, 'Test');

    expect($result)->toHaveCount(2)
        ->and($result[0]['src'])->toContain('a.jpg')
        ->and($result[0]['width'])->toBe(1920);
});
```

### Feature: extend `ClientPageDataBindingTest.php`

```php
public function test_gallery_pages_render_lightbox_markup(): void
{
    $album = EventAlbum::factory()->create(['slug' => 'lightbox-test', 'status' => 'published']);
    foreach (range(1, 3) as $i) {
        $album->media()->create($this->mediaAttributes("event-gallery-{$i}.png"));
    }
    $this->createPage('event-photos');

    $this->get('/event-photos/lightbox-test')
        ->assertOk()
        ->assertSee('data-gallery', false)
        ->assertSee('data-gallery-index', false)
        ->assertSee('gallery-trigger', false)
        ->assertSee('event-gallery-3.png'); // all 3 visible
}
```

Routes to cover:
- `/event-photos/{slug}` (detail)
- `/event-photos` (index)
- `/faces-and-places/{slug}` (detail)
- `/faces-and-places` (index)

## Related Code Files

- Create: `app/Support/GalleryImage.php`
- Create: `tests/Unit/GalleryImageTest.php`
- Modify: `tests/Feature/ClientPageDataBindingTest.php`
- Verify only: `app/Http/Controllers/Client/EventPhotoController.php`
- Verify only: `app/Http/Controllers/Client/FacesAndPlacesController.php`

## Implementation Steps

1. Create `GalleryImage.php` with `fromMediaCollection`, `fromMedia`, `fromPaths`
2. Write unit tests
3. Add feature test for lightbox markup on 4 routes
4. Run `php artisan test --filter=GalleryImage`
5. Run `ClientPageDataBindingTest`
6. Manual QA: PhotoSwipe open/close, thumb strip sync

## Success Criteria

- [ ] `GalleryImage` unit tests pass
- [ ] Feature tests assert lightbox markup on P1 pages
- [ ] Album with 10+ images renders all in grid HTML (no take(8))
- [ ] Full test suite green

## Risk Assessment

| Risk | Mitigation |
|------|------------|
| PhotoSwipe needs width/height | Populate from Media; fallback 1920×1280 |
| Large albums slow page load | `loading="lazy"` on grid imgs; PhotoSwipe lazy loads |

## Future Enhancements (post-v1)

- Home F&P section lightbox (deferred P2)
- Responsive thumbnails via `MediaProcessor`
- Pinch-to-zoom via PhotoSwipe `zoom` option
- Playwright E2E
