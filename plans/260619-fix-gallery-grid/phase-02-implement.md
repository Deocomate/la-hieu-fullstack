---
phase: 2
title: "Implement"
status: completed
priority: P1
effort: "2h"
dependencies: ["1"]
---

# Phase 2: Implement

## Overview
Refactor the `detail-gallery-grid.blade.php` component to implement the responsive 12-column alternating grid layout on desktop, while preserving the masonry layout on mobile/tablet.

## Requirements
- Functional:
  - Implement a 12-column grid layout on desktop (`lg:` breakpoint) with a 15px gap.
  - Dynamically assign `wrapperClass` and `imageClass` to `grid-trigger` based on the item index.
  - Ensure images are cropped cleanly using `object-cover` to fit the 340px height on desktop.
- Non-functional:
  - No broken layouts on any screen size.
  - No impact on the lightbox or image loading performance.

## Architecture
The `detail-gallery-grid.blade.php` component will be updated to:
1. Loop through `$lightboxImages` with `$index`.
2. Compute the column span and height classes for each item:
   ```php
   $mod = $index % 8;
   $isWide = in_array($mod, [0, 2, 5, 7]);
   $spanClass = $isWide ? 'lg:col-span-4' : 'lg:col-span-2';
   $wrapperClass = "w-full break-inside-avoid mb-[10px] lg:mb-0 {$spanClass} lg:h-[340px] overflow-hidden group relative shadow-sm";
   $imageClass = "w-full h-auto lg:h-full object-cover transition-transform duration-700 group-hover:scale-105";
   ```
3. Pass these classes to `x-clients.gallery.grid-trigger`.

The container will be styled as:
```html
<div class="w-full columns-2 md:columns-3 lg:grid lg:grid-cols-12 gap-[10px] lg:gap-[15px]" data-aos="fade-up">
```

## Related Code Files
- Modify: `resources/views/components/clients/shared/detail-gallery-grid.blade.php`

## Implementation Steps
1. Update `resources/views/components/clients/shared/detail-gallery-grid.blade.php` with the new PHP class computation logic.
2. Update the container classes to support both `columns` (mobile/tablet) and `lg:grid` (desktop).
3. Pass the computed `wrapperClass` and `imageClass` to the `grid-trigger` component inside the loop.

## Success Criteria
- [x] Detail gallery grid matches the Figma design perfectly on desktop (12-column alternating grid with 340px height).
- [x] Mobile and tablet layouts remain fully responsive and use a beautiful masonry layout.
- [x] No linter or syntax errors are introduced.
