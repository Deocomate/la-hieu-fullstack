---
phase: 1
title: "Research & Audit"
status: pending
priority: P2
effort: "30m"
dependencies: []
---

# Phase 1: Research & Audit

## Overview

Xác nhận reference implementation trên Photojournalism và audit DOM/layout 3 trang đích để tránh hover bị cắt bởi padding hoặc `max-w` container.

## Requirements

- Functional: Hiểu chính xác element nào trigger hover và element nào nhận background
- Non-functional: Hover phải full-bleed viewport (trừ Event Photos sidebar — documented exception)

## Architecture

**Photojournalism flow:**

```
VideographyController (missing cardLayout)
    ↓
article-list (cardLayout default 'zigzag')
    ↓
<a class="group"> → article-card (variant hover → before pseudo)
```

**F&P flow:**

```
fap-gallery-contain-section (px on section — blocks full bleed)
    ↓
fap-gallery-item (max-w-[1320px] grid only)
```

**Event Photos flow:**

```
gallery-section
    ├── aside#album-nav → li.album-nav-item (click target)
    └── #gallery-container → masonry images (separate hover: scale + black/10)
```

## Related Code Files

- Read: `app/Http/Controllers/Client/PhotojournalismController.php`
- Read: `app/Http/Controllers/Client/VideographyController.php`
- Read: `resources/views/components/clients/shared/article-list.blade.php`
- Read: `resources/views/components/clients/shared/article-card.blade.php`
- Read: `resources/views/client/faces-and-places/partials/fap-gallery-contain-section.blade.php`
- Read: `resources/views/client/event-photos/partials/gallery-section.blade.php`

## Implementation Steps

1. Mở `/photojournalism` — xác nhận hover band full-width, transition mượt, không layout shift
2. So sánh `/videography` — xác nhận đang dùng zigzag (card đầu có `bg #FAFAFA` static, không hover)
3. Kiểm tra `/faces-and-places` — mỗi album là 1 block; note padding `px-[30px]` trên `<section>`
4. Kiểm tra `/event-photos` — sidebar `album-nav-item`; mobile dùng prev/next, không có sidebar
5. Ghi lại breakpoint behavior: mobile F&P và Videography dùng layout stacked trong `article-card`
6. Confirm không có plan unfinished conflict trong `./plans/`

## Audit Checklist

| Page | Hover target | Full-bleed possible? | Action |
|------|-------------|---------------------|--------|
| Photojournalism | `<a.group>` + card surface | ✅ Yes | Reference only |
| Videography | Same components | ✅ Yes | Enable `cardLayout: hover` |
| Faces & Places | Per-album wrapper | ⚠️ Needs padding move | Restructure wrapper |
| Event Photos | Sidebar `<li>` | — | **Out of scope** (validated) |

## Success Criteria

- [ ] Documented DOM path cho hover trên cả 4 trang (PJ + 3 targets)
- [ ] Xác nhận Videography thiếu `cardLayout` (không phải bug component)
- [ ] Xác nhận F&P padding location gây cản full-bleed
- [ ] Event Photos confirmed out of scope

## Risk Assessment

- **Assumption risk:** User có thể muốn Event Photos giống hệt card list — mitigate bằng validate step trước Phase 5
- **Mobile Event Photos:** Không có sidebar — hover effect chỉ desktop; ghi chú trong QA manual checklist
