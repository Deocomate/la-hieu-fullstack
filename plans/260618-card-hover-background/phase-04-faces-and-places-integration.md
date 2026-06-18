---
phase: 4
title: "Faces and Places Integration"
status: pending
priority: P1
effort: "45m"
dependencies: [2]
---

# Phase 4: Faces and Places Integration

## Overview

Bọc mỗi album block trên Faces & Places index bằng full-width hover surface, di chuyển horizontal padding vào inner container để background tràn viewport.

## Requirements

- Functional: Hover anywhere trên album block (title + grid) → band `#FAFAFA` full viewport width
- Non-functional: Giữ spacing vertical giữa albums (`gap-[50px] lg:gap-[80px]` hoặc tương đương qua padding)
- Non-functional: Lightbox / `data-gallery` markup không đổi

## Architecture

**Before:**

```html
<section class="... px-[30px] md:px-4 ...">
  <div class="gap-[50px]">
    <fap-gallery-item />  <!-- per album -->
  </div>
</section>
```

**After:**

```html
<section class="... pb-[50px] ...">  <!-- no horizontal px -->
  <div class="flex flex-col">
    @foreach albums
      <div class="w-full group card-section-hover-surface pt-[50px] lg:pt-[80px]">
        <div class="px-[30px] md:px-4">
          <fap-gallery-item />
        </div>
      </div>
    @endforeach
  </div>
</section>
```

**Spacing note:** Thay `gap` bằng `pt` trên mỗi wrapper (trừ album đầu có padding top nhỏ hơn nếu cần khớp design hiện tại).

## Related Code Files

- Modify: `resources/views/client/faces-and-places/partials/fap-gallery-contain-section.blade.php`
- Read only: `resources/views/client/faces-and-places/partials/fap-gallery-item.blade.php`

## Implementation Steps

1. Mở `fap-gallery-contain-section.blade.php`
2. Bỏ `px-[30px] md:px-4` khỏi `<section>` outer
3. Bỏ `gap-[50px] lg:gap-[80px]` trên flex container (spacing chuyển sang per-item padding)
4. Trong `@foreach ($albums as $index => $album)`:
   - Wrap `@include('...fap-gallery-item')` trong:

```blade
<div @class([
    'w-full group card-section-hover-surface',
    'pt-[30px] lg:pt-[50px]' => $index === 0,
    'pt-[50px] lg:pt-[80px]' => $index > 0,
])>
    <div class="w-full px-[30px] md:px-4">
        @include('client.faces-and-places.partials.fap-gallery-item', [...])
    </div>
</div>
```

5. Giữ nguyên tất cả props truyền vào `fap-gallery-item` (galleryId, lightboxImages, etc.)
6. **Không sửa** `fap-gallery-item.blade.php` — nested `group` trên image slots độc lập với parent `group`
7. Manual QA `/faces-and-places`:
   - Hover album 1, 2, ... — band full width
   - Click ảnh — lightbox vẫn hoạt động
   - AOS animations không bị flicker

## Success Criteria

- [ ] Horizontal padding chỉ ở inner wrapper, không ở hover surface
- [ ] Mỗi album có `group card-section-hover-surface`
- [ ] Vertical rhythm tương đương design cũ (±8px acceptable)
- [ ] `fap-gallery-item` unchanged
- [ ] Lightbox regression test vẫn pass

## Risk Assessment

| Risk | Mitigation |
|------|------------|
| Album đầu spacing khác hero | Dùng conditional `$index === 0` padding |
| `group` conflict với image `group-hover:scale-105` | Tailwind nested groups: child `group-hover` chỉ affect child; parent `group:hover .card-section-hover-surface::before` vẫn work |
| First album quá sát hero | Tune `pt-[30px] lg:pt-[50px]` cho index 0 |
