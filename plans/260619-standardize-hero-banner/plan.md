---
title: "Standardize Hero Banner Components"
description: "Split hero-banner into index and detail variants with data-only props; remove per-page class/style overrides."
status: completed
priority: P2
branch: "main"
tags: ["frontend", "refactor", "components"]
blockedBy: []
blocks: []
created: "2026-06-19T10:06:27.803Z"
createdBy: "ck:plan"
source: skill
---

# Standardize Hero Banner Components

## Overview

`hero-banner.blade.php` hiện là một component “god object”: mỗi trang truyền vào `paddingTop`, `paddingBottom`, `headingClass`, `subtitleClass` — dẫn đến style drift khó đồng bộ giữa 8 call site (4 index + 4 detail).

**Mục tiêu:** Tách thành 2 component chuyên biệt — **Index Hero Banner** và **Detail Hero Banner** — chỉ nhận **dữ liệu** (`title`, `subtitle`, `description`, `bgText`). Toàn bộ spacing, typography, divider được bake sẵn trong component.

## Problem Statement

| Call site | Style props truyền vào |
|-----------|------------------------|
| `event-photos/index` | `paddingTop`, `paddingBottom` |
| `faces-and-places/index` | `paddingTop`, `paddingBottom` |
| `photojournalism/index` | _(defaults)_ |
| `videography/index` | _(defaults)_ |
| `event-photos/detail` | `paddingTop`, `paddingBottom`, `headingClass`, `subtitleClass` |
| `faces-and-places/detail` | `paddingTop`, `paddingBottom`, `headingClass`, `subtitleClass` |
| `photojournalism/detail` | `paddingTop`, `paddingBottom`, `headingClass`, `subtitleClass` |
| `videography/detail` | `paddingTop`, `paddingBottom`, `headingClass`, `subtitleClass` |

Detail pages gần như copy-paste cùng một bộ class nhưng vẫn lệch nhẹ (ví dụ `event-photos/detail` thêm `md:font-bold`, `pt-[35px]` vs `pt-[45px]` ở photojournalism). Index pages cũng override padding không thống nhất.

## Target Architecture

```
components/clients/hero/
├── index-banner.blade.php      ← Index pages (listing)
├── detail-banner.blade.php     ← Detail pages (album/article)
└── partials/
    └── bg-text.blade.php       ← Shared SVG background text logic
```

**Index Banner — data-only props:**
```php
@props([
    'title',
    'subtitle' => null,
    'description' => null,
    'bgText' => null,
])
```

**Detail Banner — data-only props:**
```php
@props([
    'title',
    'subtitle' => null,
    'bgText' => null,
])
```

**Không còn:** `paddingTop`, `paddingBottom`, `headingClass`, `subtitleClass`.

## Canonical Styles (baked in)

### Index variant
| Element | Classes |
|---------|---------|
| Section padding | `pt-[35px] lg:pt-[80px] pb-[20px] lg:pb-[80px]` |
| Heading | `text-[36px] md:text-hero-lg font-extrabold tracking-[1.8px] md:tracking-normal` |
| Subtitle | `text-body-16-norm font-thin mt-[5px]` |
| Description | `font-light text-[14px] leading-[22px] max-w-[430px] mt-[24px] mb-8 lg:mb-[47px]` |
| Divider | `w-[2px] h-[38px] bg-[#C5AA82] mt-[22px]` |

> Per-page padding drift (`pt-[40px]`, `pt-[33px]`, `pb-[50px]`) sẽ **unify** về bộ trên (validated Session 1).

### Detail variant
| Element | Classes |
|---------|---------|
| Section padding | `pt-[33px] lg:pt-[80px] pb-[20px] lg:pb-[60px]` |
| Heading | `text-[24px] md:text-hero-md font-extrabold tracking-[1.2px] md:tracking-normal` |
| Subtitle | `text-body-16-norm font-light md:mt-6 lg:mt-[5px]` |
| Divider | Same as index |
| Description | Không render (detail không dùng) |

## Migration Map

| File | Before | After |
|------|--------|-------|
| `event-photos/index.blade.php` | `hero-banner` + 4 style props | `<x-clients.hero.index-banner>` data only |
| `faces-and-places/index.blade.php` | `hero-banner` + 2 style props | `<x-clients.hero.index-banner>` data only |
| `photojournalism/index.blade.php` | `hero-banner` defaults | `<x-clients.hero.index-banner>` data only |
| `videography/index.blade.php` | `hero-banner` defaults | `<x-clients.hero.index-banner>` data only |
| `event-photos/detail.blade.php` | `hero-banner` + 4 style props | `<x-clients.hero.detail-banner>` data only |
| `faces-and-places/detail.blade.php` | `hero-banner` + 4 style props | `<x-clients.hero.detail-banner>` data only |
| `photojournalism/detail.blade.php` | `hero-banner` + 4 style props | `<x-clients.hero.detail-banner>` data only |
| `videography/detail.blade.php` | `hero-banner` + 4 style props | `<x-clients.hero.detail-banner>` data only |

**Delete:** `components/clients/shared/hero-banner.blade.php` sau khi migrate xong (không giữ wrapper deprecated — YAGNI).

## Out of Scope
- Home page hero (`home/partials/hero-section.blade.php`) — layout khác hoàn toàn (ảnh, không có SVG bg text).
- Contact page hero — typography riêng (`text-hero-lg-contact`).
- Detail slider sections (`detail-hero-slider-section`) — giữ nguyên, chỉ banner text bên dưới được refactor.
- Thay đổi CMS/Filament fields (`hero_title`, `hero_bg_text`, etc.) — đã đủ, không cần schema mới.

## Phases

| Phase | Name | Status |
|-------|------|--------|
| 1 | [Research](./phase-01-research.md) | Completed |
| 2 | [Implement](./phase-02-implement.md) | Completed |
| 3 | [Test](./phase-03-test.md) | Completed |

## Dependencies
None. Standalone frontend refactor, không phụ thuộc plan gallery grid.

## Validation Log

### Session 1 — 2026-06-19
**Trigger:** User requested plan validation before implementation.
**Questions asked:** 4

#### Questions & Answers

1. **[Scope]** Index pages hiện có padding khác nhau (pt 33/35/40px). Bạn muốn xử lý thế nào?
   - Options: Unify tất cả index pages về một bộ padding chuẩn (Recommended) | Dùng prop section enum
   - **Answer:** Unify tất cả index pages về một bộ padding chuẩn (Recommended)
   - **Rationale:** Loại bỏ hoàn toàn style drift; một bộ padding duy nhất cho index variant.

2. **[Architecture]** API gọi component mới nên dùng dạng nào?
   - Options: `<x-clients.hero.index-banner>` Blade component (Recommended) | `@include`
   - **Answer:** `<x-clients.hero.index-banner>` / `<x-clients.hero.detail-banner>` (Recommended)
   - **Rationale:** Khớp convention hiện tại (`x-clients.gallery.grid-trigger`, `x-clients.shared.article-card`).

3. **[Assumptions]** Detail banner khi subtitle rỗng thì xử lý thế nào?
   - Options: Ẩn subtitle + divider khi rỗng (Recommended) | Luôn render
   - **Answer:** Ẩn subtitle + divider khi subtitle rỗng (Recommended)
   - **Rationale:** Tránh khoảng trống thừa khi album/article không có ngày.

4. **[Scope]** Sau migrate, xử lý component cũ thế nào?
   - Options: Xóa hero-banner.blade.php (Recommended) | Giữ wrapper deprecated
   - **Answer:** Xóa sau migrate (Recommended)
   - **Rationale:** YAGNI — grep xác nhận chỉ 8 call site, migrate hết rồi xóa sạch.

#### Confirmed Decisions
- **Index padding:** Unified — `pt-[35px] lg:pt-[80px] pb-[20px] lg:pb-[80px]` cho tất cả index pages.
- **Component API:** Blade `<x-clients.hero.index-banner>` và `<x-clients.hero.detail-banner>`.
- **Empty subtitle:** `@if ($subtitle)` — ẩn cả subtitle và gold divider.
- **Old component:** Delete `shared/hero-banner.blade.php` after migration.

#### Action Items
- [ ] Detail banner: wrap subtitle + divider trong `@if ($subtitle)`.
- [ ] Migrate 8 call sites sang Blade component syntax.
- [ ] Delete old hero-banner after grep confirms zero references.

#### Impact on Phases
- Phase 2: Use Blade component API; add empty-subtitle guard in detail-banner.
- Phase 3: Grep for zero `hero-banner` references before marking done.

### Verification Results
- **Tier:** Standard
- **Claims checked:** 6
- **Verified:** 6 | **Failed:** 0 | **Unverified:** 0
- Verified: 8 call sites, hero-banner.blade.php exists, x-clients.* convention exists, home/contact out of scope confirmed.

### Whole-Plan Consistency Sweep
- Files reread: plan.md, phase-01-research.md, phase-02-implement.md, phase-03-test.md
- Decision deltas checked: 4
- Reconciled stale references: 0
- Unresolved contradictions: 0

## Risk Summary
- **Visual regression:** Unifying padding có thể lệch Figma nhẹ ở 1-2 trang — cần visual QA sau implement.
- **Blade component namespace:** Dùng `x-clients.hero.index-banner` theo convention hiện tại (`x-clients.gallery.grid-trigger`).
