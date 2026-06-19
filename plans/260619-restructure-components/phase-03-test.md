---
phase: 3
title: "Test"
status: pending
priority: P2
effort: "1.5h"
dependencies: [2]
---

# Phase 3: Test

## Overview

Xác minh refactor không làm hỏng render, data binding, pagination, lightbox, view composers, và **toàn bộ home/about/contact page sections**.

<!-- Updated: Validation Session 1 - expanded smoke URLs -->

## Requirements

- Functional: Tất cả client routes trả 200; nội dung động (settings, social feeds) vẫn hiển thị
- Non-functional: Không regression trong feature test hiện có

## Architecture

```
php artisan test --filter=ClientPage
     ↓
Manual smoke (optional): home, 1 index, 1 detail, contact
     ↓
rg verification (zero stale paths)
```

## Related Code Files

- `tests/Feature/ClientPageDataBindingTest.php`
- Toàn bộ `resources/views/client/**` (render paths)

## Implementation Steps

1. **Automated tests**
   ```powershell
   php artisan view:clear
   php artisan test --filter=ClientPage
   php artisan test
   ```

2. **Static verification**
   ```powershell
   rg "components\.clients\.(shared|follow-section|pagination|header|footer|styles|scripts)" resources/ app/
   rg "client\.(home|about|contact|event-photos|faces-and-places|photojournalism|videography)\.partials" resources/
   rg "fap-gallery-image-slot|detail-gallery-grid|follow-section" resources/
   ```
   Tất cả phải trả 0 (hoặc chỉ trong plan docs).

3. **Manual smoke checklist** (nếu dev server đang chạy `php artisan serve`)

   | URL | Kiểm tra |
   |-----|----------|
   | `/` | 6 home sections, partners, follow, header/footer |
   | `/about` | About main section |
   | `/contact` | Contact form + footer settings composer |
   | `/photojournalism` | Hero, article list, pagination |
   | `/event-photos` | Gallery section (index) |
   | `/event-photos/{slug}` | Detail hero, gallery grid, lightbox |
   | `/faces-and-places` | FAP gallery-contain + gallery-item layout |
   | `/photojournalism/{slug}` | Detail hero slider (Swiper) |
   | `/videography/{slug}` | Detail hero slider (Swiper) |

4. **View composer spot-check**
   - Footer: `footer_author_name` từ DB/settings
   - Follow section: `SocialFeed` records render

5. **Compiled views**
   - Confirm không còn stale paths trong `storage/framework/views/` sau `view:clear`

## Success Criteria

- [ ] `php artisan test` pass (hoặc ít nhất `ClientPageDataBindingTest` pass)
- [ ] Grep verification: 0 stale component paths
- [ ] Manual smoke: header/footer/follow/gallery hoạt động
- [ ] Lightbox mở từ grid-trigger và detail-grid
- [ ] Pagination links render trên index pages có paginate

## Risk Assessment

- Tests có thể không cover mọi `@include` path — grep + manual smoke bù gap.
- Nếu test fail do missing view: trace `ViewException` message → fix path typo, re-run.
