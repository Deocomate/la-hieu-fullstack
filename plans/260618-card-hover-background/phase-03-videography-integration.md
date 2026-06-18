---
phase: 3
title: "Videography Integration"
status: pending
priority: P1
effort: "15m"
dependencies: [2]
---

# Phase 3: Videography Integration

## Overview

Bật `cardLayout: hover` cho trang Videography index — thay đổi tối thiểu vì đã dùng chung `article-list` + `article-card`.

## Requirements

- Functional: Mỗi videography article card hover → background `#FAFAFA` full-width
- Non-functional: Route `videography.show` vẫn đúng (đã handle trong `article-list`)

## Architecture

```
VideographyController::index()
    → cardLayout: 'hover'
    → videography/index.blade.php
    → article-list (same as Photojournalism)
```

## Related Code Files

- Modify: `app/Http/Controllers/Client/VideographyController.php`
- Modify: `resources/views/client/videography/index.blade.php`

## Implementation Steps

1. **Controller** — đổi `compact()` sang array return giống Photojournalism:

```php
return view('client.videography.index', [
    'articles' => $articles,
    'page' => $page,
    'cardLayout' => 'hover',
]);
```

2. **View** — truyền `cardLayout` vào include (mirror `photojournalism/index.blade.php`):

```blade
@include('components.clients.shared.article-list', ['cardLayout' => $cardLayout ?? 'zigzag'])
```

   Hiện tại `videography/index.blade.php` gọi `@include('components.clients.shared.article-list')` **không** truyền prop → fallback `zigzag`.

3. Verify `/videography`:
   - Desktop: hover band full width
   - Mobile: stacked layout với hover
   - Link điều hướng `videography.show` (không `photojournalism.show`)

## Success Criteria

- [ ] `VideographyController` trả về `cardLayout => 'hover'`
- [ ] `videography/index.blade.php` forward `cardLayout` to article-list
- [ ] Visual parity với `/photojournalism` card hover
- [ ] Zigzag layout không còn trên videography index

## Risk Assessment

- **Low risk** — 2 file, pattern đã proven trên Photojournalism
- Pagination articles không ảnh hưởng hover logic
