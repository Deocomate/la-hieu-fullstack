---
phase: 2
title: "Shared Hover Utility"
status: pending
priority: P1
effort: "30m"
dependencies: [1]
---

# Phase 2: Shared Hover Utility

## Overview

Trích xuất chuỗi Tailwind hover surface từ `article-card.blade.php` thành CSS utility `.card-section-hover-surface` dùng chung cho tất cả trang.

## Requirements

- Functional: `group:hover` (hoặc `.group:hover .card-section-hover-surface`) hiển thị `#FAFAFA` với opacity transition 500ms ease-in-out
- Non-functional: Không thay đổi visual Photojournalism sau refactor

## Architecture

```css
/* styles.blade.php */
.card-section-hover-surface {
    position: relative;
    isolation: isolate;
}
.card-section-hover-surface::before {
    content: '';
    position: absolute;
    inset: 0;
    background-color: #FAFAFA;
    opacity: 0;
    transition: opacity 500ms ease-in-out;
    pointer-events: none;
    z-index: -1;
}
.group:hover .card-section-hover-surface::before,
.card-section-hover-surface.group:hover::before {
    opacity: 1;
}
```

**Hai pattern sử dụng:**

| Pattern | HTML | Khi nào dùng |
|---------|------|-------------|
| Parent `group` | `<a class="group"><div class="card-section-hover-surface">` | article-list (link bọc card) |
| Self `group` | `<div class="group card-section-hover-surface">` | F&P album wrapper |

## Related Code Files

- Modify: `resources/views/components/clients/styles.blade.php`
- Modify: `resources/views/components/clients/shared/article-card.blade.php`

## Implementation Steps

1. Thêm block CSS ở cuối `<style>` trong `styles.blade.php` (sau font/typography rules)
2. Trong `article-card.blade.php`:
   - Xóa biến `$hoverSurfaceClass` với chuỗi Tailwind dài
   - Thay bằng: `$hoverSurfaceClass = $isHoverVariant ? 'card-section-hover-surface' : ''`
3. Giữ nguyên logic `$isHoverVariant`, `$bgColor`, `@unless($isHoverVariant) style=...`
4. Manual verify `/photojournalism` — hover band identical trước/sau

## Code Snippet (article-card change)

```blade
@php
    $isHoverVariant = $variant === 'hover';
    $hoverSurfaceClass = $isHoverVariant ? 'card-section-hover-surface' : '';
@endphp
```

## Success Criteria

- [ ] `.card-section-hover-surface` defined once in `styles.blade.php`
- [ ] `article-card` không còn duplicate Tailwind `before:` chain
- [ ] Photojournalism hover visually unchanged (desktop + mobile)
- [ ] CSS supports both parent-`group` and self-`group` patterns

## Risk Assessment

| Risk | Mitigation |
|------|------------|
| Specificity conflict với Tailwind | Đặt rule sau Tailwind CDN; dùng plain CSS không `@apply` |
| z-index stacking với AOS animations | Giữ `z-index: -1` trên `::before` như bản gốc |
