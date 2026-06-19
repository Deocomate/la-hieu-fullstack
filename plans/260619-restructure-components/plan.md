---
title: "Restructure Blade Components Tree"
description: "Reorganize resources/views/components into domain folders, unify invocation style, and eliminate the ambiguous shared/ bucket."
status: pending
priority: P2
branch: "main"
tags: ["frontend", "refactor", "blade", "components"]
blockedBy: [260619-static-assets-performance]
blocks: []
created: "2026-06-19T10:18:28.376Z"
createdBy: "ck:plan"
source: skill
---

# Restructure Blade Components Tree

## Overview

Thư mục `resources/views/components` hiện có **17 file** nhưng phân chia chưa nhất quán:

| Vấn đề | Ví dụ |
|--------|-------|
| File layout chrome nằm lẫn ở root `clients/` | `header`, `footer`, `styles`, `scripts` |
| Bucket `shared/` gom nhiều domain khác nhau | article card/list + gallery grid + content blocks |
| Gallery component đặt tên theo page | `fap-gallery-image-slot` trong folder `gallery/` |
| Hai cách gọi component song song | `<x-clients.hero.*>` vs `@include('components.clients.*')` |
| View composer hard-code path cũ | `AppServiceProvider` → `components.clients.follow-section` |

**Mục tiêu:** Cây thư mục theo **domain** (chrome, hero, article, gallery, sections, ui), đặt tên file ngắn gọn trong từng domain, chuẩn hóa gọi component bằng `<x-clients.{domain}.{name}>`, cập nhật toàn bộ call site và View composer.

**Phạm vi:** Chỉ client-facing Blade components. Không đụng Filament/admin views. Không đổi logic/UI.

## Current State

```
components/
├── layouts/main-client.blade.php
└── clients/
    ├── header.blade.php, footer.blade.php, styles.blade.php, scripts.blade.php
    ├── pagination.blade.php, follow-section.blade.php
    ├── hero/          ✅ đã tách (plan 260619-standardize-hero-banner)
    ├── shared/        ⚠️ catch-all
    └── gallery/       ⚠️ mixed generic + FAP-specific naming
```

**17 call sites** trong `resources/views/client/**` và `components/**` cần cập nhật path.

## Target Architecture

```
components/
├── layouts/
│   └── main-client.blade.php
└── clients/
    ├── chrome/
    │   ├── header.blade.php
    │   ├── footer.blade.php
    │   ├── styles.blade.php
    │   └── scripts.blade.php
    ├── hero/
    │   ├── index-banner.blade.php
    │   ├── detail-banner.blade.php
    │   └── partials/bg-text.blade.php
    ├── article/
    │   ├── card.blade.php
    │   ├── list.blade.php
    │   └── detail-content.blade.php
    ├── gallery/
    │   ├── detail-grid.blade.php
    │   ├── grid-trigger.blade.php
    │   ├── image-slot.blade.php
    │   └── lightbox.blade.php
    ├── sections/
    │   └── follow.blade.php
    ├── pages/                           # ← mới: gom client/**/partials/
    │   ├── home/
    │   │   ├── hero.blade.php
    │   │   ├── event-photography.blade.php
    │   │   ├── photojournalism.blade.php
    │   │   ├── videography.blade.php
    │   │   ├── faces-and-places.blade.php
    │   │   └── partners.blade.php
    │   ├── about/main.blade.php
    │   ├── contact/main.blade.php
    │   ├── event-photos/gallery.blade.php
    │   ├── faces-and-places/
    │   │   ├── gallery-contain.blade.php
    │   │   └── gallery-item.blade.php
    │   ├── photojournalism/detail-hero-slider.blade.php
    │   └── videography/detail-hero-slider.blade.php
    └── ui/
        └── pagination.blade.php
```

### Naming & Invocation Rules

| Rule | Detail |
|------|--------|
| Folder = domain | `chrome`, `article`, `gallery`, `sections`, `ui` |
| File = role | `card.blade.php` not `article-card.blade.php` (domain đã nói rõ) |
| Blade tag | `<x-clients.{domain}.{file}>` — ví dụ `<x-clients.article.list>` |
| Layout shell | Giữ `@extends('components.layouts.main-client')` |
| Chrome in layout | `main-client` dùng `@include` cho `styles`/`scripts` (head/body assets) hoặc chuyển sang `<x-clients.chrome.*>` — **ưu tiên `<x-clients.chrome.*>`** cho nhất quán |
| Internal partials | `@include` chỉ trong cùng domain (`hero/partials/`) |
| View composers | Cập nhật sang path mới `components.clients.sections.follow` |

### File Migration Map

| From | To | New tag |
|------|-----|---------|
| `clients/header.blade.php` | `clients/chrome/header.blade.php` | `<x-clients.chrome.header />` |
| `clients/footer.blade.php` | `clients/chrome/footer.blade.php` | `<x-clients.chrome.footer />` |
| `clients/styles.blade.php` | `clients/chrome/styles.blade.php` | `@include` hoặc `<x-clients.chrome.styles />` |
| `clients/scripts.blade.php` | `clients/chrome/scripts.blade.php` | idem |
| `clients/follow-section.blade.php` | `clients/sections/follow.blade.php` | `<x-clients.sections.follow />` |
| `clients/pagination.blade.php` | `clients/ui/pagination.blade.php` | `->links('components.clients.ui.pagination')` |
| `clients/shared/article-card.blade.php` | `clients/article/card.blade.php` | `<x-clients.article.card />` |
| `clients/shared/article-list.blade.php` | `clients/article/list.blade.php` | `<x-clients.article.list />` |
| `clients/shared/detail-content-blocks.blade.php` | `clients/article/detail-content.blade.php` | `<x-clients.article.detail-content />` |
| `clients/shared/detail-gallery-grid.blade.php` | `clients/gallery/detail-grid.blade.php` | `<x-clients.gallery.detail-grid />` |
| `clients/gallery/fap-gallery-image-slot.blade.php` | `clients/gallery/image-slot.blade.php` | `<x-clients.gallery.image-slot />` |
| `clients/gallery/grid-trigger.blade.php` | _(giữ path)_ | `<x-clients.gallery.grid-trigger />` |
| `clients/gallery/lightbox.blade.php` | _(giữ path)_ | `<x-clients.gallery.lightbox />` |
| `clients/hero/*` | _(giữ path)_ | không đổi |
| `client/home/partials/*.blade.php` | `clients/pages/home/*.blade.php` | `<x-clients.pages.home.hero />` … |
| `client/about/partials/about-section` | `clients/pages/about/main.blade.php` | `<x-clients.pages.about.main />` |
| `client/contact/partials/contact-main-section` | `clients/pages/contact/main.blade.php` | `<x-clients.pages.contact.main />` |
| `client/event-photos/partials/gallery-section` | `clients/pages/event-photos/gallery.blade.php` | `<x-clients.pages.event-photos.gallery />` |
| `client/faces-and-places/partials/fap-gallery-*` | `clients/pages/faces-and-places/gallery-*` | `<x-clients.pages.faces-and-places.gallery-item />` |
| `client/*/partials/detail-hero-slider-section` | `clients/pages/{domain}/detail-hero-slider.blade.php` | `<x-clients.pages.photojournalism.detail-hero-slider />` |

### Page Partials → Components (13 files)

Sau migrate, `client/**/partials/` **bị xóa**; page index/detail chỉ `@section('content')` + `<x-clients.*>`.

## Phases

| Phase | Name | Status |
|-------|------|--------|
| 1 | [Research](./phase-01-research.md) | Pending |
| 2 | [Implement](./phase-02-implement.md) | Pending |
| 3 | [Test](./phase-03-test.md) | Pending |

## Dependencies

- **Không block** bởi plan khác. Plan `260619-standardize-hero-banner` (completed) đã tách `hero/` — plan này **giữ nguyên** `hero/`.
- **Không conflict** với `260619-fix-gallery-grid` (completed) — chỉ di chuyển `detail-gallery-grid`, không đổi layout grid.

## Out of Scope

- Tách `styles.blade.php` / `scripts.blade.php` thành Vite entry (refactor asset pipeline)
- Tạo PHP `View\Component` classes (project hiện dùng anonymous components)
- Admin/Filament component tree
- Gộp `photojournalism/detail-hero-slider` và `videography/detail-hero-slider` thành một component (CSS/behavior khác nhau — giữ 2 file riêng trong `pages/`)

## Risk Summary

| Risk | Mitigation |
|------|------------|
| Missed `@include` / `<x-*>` reference | `rg` toàn repo trước và sau migrate |
| View composer path stale | Cập nhật `AppServiceProvider` + grep `components.clients` |
| Compiled view cache | `php artisan view:clear` sau migrate |
| Pagination custom view path | Cập nhật trong `article/list.blade.php` |
| Contact view composer path | `client.contact.partials.contact-main-section` → `components.clients.pages.contact.main` |
| Nested partial `@include` | `fap-gallery-contain` include `gallery-item` → `<x-clients.pages.faces-and-places.gallery-item />` |

## Validation Log

### Session 1 — 2026-06-19
**Trigger:** User selected `/ck:plan validate` after plan creation.

#### Questions & Answers

1. **[Architecture]** Layout shell gọi chrome thế nào?
   - **Answer:** Chuyển toàn bộ chrome sang `<x-clients.chrome.*>` kể cả styles/scripts
   - **Rationale:** Một convention duy nhất; path folder phản ánh qua tag Blade.

2. **[Naming]** `fap-gallery-image-slot` đặt tên mới?
   - **Answer:** `image-slot` (generic trong `gallery/`)
   - **Rationale:** Domain đã nằm ở folder; component nhận `aspect` prop — không FAP-only.

3. **[Scope]** Mở rộng sang `client/**/partials/`?
   - **Answer:** Full audit — gom 13 partial vào `clients/pages/`
   - **Rationale:** User muốn một cây component thống nhất, không còn partial rải rác.

4. **[Architecture]** Giữ namespace `clients/`?
   - **Answer:** Giữ — `x-clients.article.card`
   - **Rationale:** Breaking change nhỏ hơn; phù hợp app chỉ có client UI.

#### Confirmed Decisions
- **Chrome:** 100% `<x-clients.chrome.*>` trong `main-client`.
- **Gallery slot:** Rename `fap-gallery-image-slot` → `image-slot`.
- **Partials:** 13 files → `clients/pages/{domain}/`.
- **Namespace:** Giữ prefix `clients/`.

#### Action Items
- [ ] Thêm bước migrate `client/**/partials/` vào phase 2.
- [ ] Cập nhật View composer contact path.
- [ ] Mở rộng grep/test checklist phase 3 cho home/about/contact pages.

#### Impact on Phases
- Phase 1: Thêm inventory 13 partials + nested include chain.
- Phase 2: Thêm `git mv` batch `pages/` và cập nhật call sites.
- Phase 3: Smoke test home, about, contact, FAP index.

### Verification Results
- **Tier:** Standard
- **Claims checked:** 8
- **Verified:** 8 | **Failed:** 0 | **Unverified:** 0
- **Evidence:** 17 component files; 13 partials; 0 `app/View/Components`; 2 View composers; grep call sites khớp plan.

### Whole-Plan Consistency Sweep
- Files reread: plan.md, phase-01-research.md, phase-02-implement.md, phase-03-test.md
- Decision deltas checked: 4
- Reconciled: Out of Scope vs partials scope; target tree + migration map extended
- Unresolved contradictions: 0
