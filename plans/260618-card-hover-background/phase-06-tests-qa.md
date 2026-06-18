---
phase: 6
title: "Tests & QA"
status: pending
priority: P2
effort: "20m"
dependencies: [3, 4]
---

# Phase 6: Tests & QA

<!-- Updated: Validation Session 1 — Event Photos out of scope; tests only Videography + F&P -->

## Overview

Thêm Pest feature assertions cho hover markup trên **Videography** và **Faces & Places** index, plus manual QA checklist.

## Requirements

- Functional: Tests assert `.card-section-hover-surface` có trong HTML response
- Non-functional: Không thêm brittle full HTML snapshot tests

## Related Code Files

- Modify: `tests/Feature/ClientPageDataBindingTest.php`

## Implementation Steps

1. Thêm test method `test_index_pages_render_card_hover_markup()`:

```php
public function test_index_pages_render_card_hover_markup(): void
{
    $this->createPage('videography');
    $this->createPage('faces-and-places');

    Article::factory()->create([
        'type' => 'videography',
        'status' => 'published',
        'title' => 'Hover Video Article',
        'slug' => 'hover-video-article',
    ]);

    FacesPlacesAlbum::factory()->create([
        'title' => 'Hover Faces Album',
        'slug' => 'hover-faces-album',
        'status' => 'published',
    ]);

    $this->get('/videography')
        ->assertOk()
        ->assertSee('card-section-hover-surface', false);

    $this->get('/faces-and-places')
        ->assertOk()
        ->assertSee('card-section-hover-surface', false);
}
```

2. Chạy: `php artisan test --filter=ClientPageDataBinding`

## Manual QA Checklist

| Page | Desktop | Mobile |
|------|---------|--------|
| `/photojournalism` | Hover band full width (regression) | Stacked hover works |
| `/videography` | Same as PJ | Same |
| `/faces-and-places` | Per-album full-bleed hover | Per-album hover |

**Additional checks:**
- [ ] No layout shift on hover
- [ ] Transition ~500ms, ease-in-out
- [ ] Lightbox still opens on F&P images
- [ ] `/event-photos` unchanged (no hover regression)

## Success Criteria

- [ ] New Pest test passes (2 pages only)
- [ ] `ClientPageDataBindingTest` full class passes
- [ ] Manual QA checklist completed
- [ ] Photojournalism regression verified post Phase 2 refactor

## Risk Assessment

- **assertSee class names** — acceptable markup contract test
