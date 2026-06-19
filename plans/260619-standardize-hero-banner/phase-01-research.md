---
phase: 1
title: "Research"
status: pending
priority: P2
effort: "1h"
dependencies: []
---

# Phase 1: Research

## Overview
Audit toàn bộ call site của `hero-banner`, so sánh style drift giữa index/detail, và xác nhận canonical styles trước khi tách component.

## Requirements
- Functional:
  - Liệt kê đầy đủ 8 call site và props đang truyền.
  - Xác định shared logic (SVG bg text) để extract vào partial.
  - Chốt canonical styles cho index vs detail variant.
- Non-functional:
  - Không thêm prop class/style mới.
  - Tuân theo Blade component convention hiện có (`x-clients.*`).

## Architecture

### Shared partial: `bg-text.blade.php`
Extract logic từ `hero-banner.blade.php` lines 9–33:
- Input: `$bgText` string
- Output: rendered SVG character images + spacers
- Dùng chung bởi cả index và detail banner

### Style drift analysis (current state)

**Index pages — padding overrides:**
| Page | paddingTop | paddingBottom |
|------|-----------|---------------|
| event-photos | `pt-[40px] lg:pt-[80px]` | `pb-[30px] lg:pb-[80px]` |
| faces-and-places | `pt-[33px] lg:pt-[80px]` | `pb-[20px] lg:pb-[50px]` |
| photojournalism | default `pt-[35px]` | default `pb-[20px] lg:pb-[80px]` |
| videography | default | default |

**Detail pages — nearly identical overrides:**
| Page | Unique differences |
|------|-------------------|
| event-photos | `md:font-bold` on heading, `font-normal` subtitle mobile, `pb-[30px]` |
| faces-and-places | Standard detail pattern |
| photojournalism | `pt-[45px]` instead of `pt-[33px]` |
| videography | Standard detail pattern |

**Decision:** Unify về một bộ styles per variant. Drift hiện tại là copy-paste artifact, không phải intentional Figma differences.

> **Validated (Session 1):** Index padding sẽ unify về `pt-[35px] lg:pt-[80px] pb-[20px] lg:pb-[80px]` — không dùng section enum.

## Related Code Files
- Read: `resources/views/components/clients/shared/hero-banner.blade.php`
- Read: All 8 consumer blade files in `resources/views/client/*/index.blade.php` and `detail.blade.php`
- Create: `resources/views/components/clients/hero/partials/bg-text.blade.php`
- Create: `resources/views/components/clients/hero/index-banner.blade.php`
- Create: `resources/views/components/clients/hero/detail-banner.blade.php`
- Delete: `resources/views/components/clients/shared/hero-banner.blade.php`

## Implementation Steps
1. Document all current props per call site (done in plan.md migration map).
2. Extract `bg-text` partial from existing hero-banner SVG logic.
3. Define canonical Tailwind classes for index and detail variants.
4. Verify no other files `@include('components.clients.shared.hero-banner')` beyond the 8 known call sites.

## Success Criteria
- [ ] All 8 call sites documented with current vs target API.
- [ ] Canonical styles defined for index and detail variants.
- [ ] Shared bg-text partial design confirmed.

## Risk Assessment
| Risk | Mitigation |
|------|------------|
| Unified padding differs from current per-page look | Visual QA on all 8 pages post-implement; revert single variant class if Figma requires section-specific spacing |
| Blade `@props` vs `@include` mix | Use `<x-clients.hero.*>` consistently for new components |
