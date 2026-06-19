---
phase: 1
title: "Research"
status: completed
priority: P2
effort: "1h"
dependencies: []
---

# Phase 1: Research

## Overview
Analyze the current detail gallery grid implementation, review the Figma design metrics, and design a responsive Tailwind CSS implementation strategy that handles dynamic image counts gracefully.

## Requirements
- Functional:
  - Identify the exact styling and structure of `detail-gallery-grid.blade.php` and `grid-trigger.blade.php`.
  - Map the Figma design's absolute dimensions to a fluid, responsive grid layout.
- Non-functional:
  - Ensure the solution is fully responsive and looks great on all screen sizes.
  - Maintain clean, readable, and maintainable Tailwind CSS classes.

## Architecture
We will map the Figma layout to a 12-column CSS Grid on desktop (`lg:` and up) where:
- A "Wide" item spans 4 columns (`lg:col-span-4`)
- A "Narrow" item spans 2 columns (`lg:col-span-2`)
- The grid has a total of 12 columns (`lg:grid-cols-12`) with a gap of 15px (`lg:gap-[15px]`)
- The height of each item is fixed to 340px (`lg:h-[340px]`)

The alternating pattern repeats every 8 items (modulo 8):
- Index % 8 == 0: Wide (span 4)
- Index % 8 == 1: Narrow (span 2)
- Index % 8 == 2: Wide (span 4)
- Index % 8 == 3: Narrow (span 2)
- Index % 8 == 4: Narrow (span 2)
- Index % 8 == 5: Wide (span 4)
- Index % 8 == 6: Narrow (span 2)
- Index % 8 == 7: Wide (span 4)

This creates two rows of 12 columns each, perfectly matching the alternating Wide-Narrow / Narrow-Wide layout from Figma.

On mobile and tablet, we will retain the existing fluid masonry layout (`columns-2 md:columns-3 gap-[10px]`) to ensure optimal presentation of vertical and horizontal images without cropping.

## Related Code Files
- Modify: `resources/views/components/clients/shared/detail-gallery-grid.blade.php`

## Implementation Steps
1. Verify the current usage of `detail-gallery-grid.blade.php` in `faces-and-places/detail.blade.php` and `event-photos/detail.blade.php`.
2. Draft the PHP logic to dynamically assign column spans and height classes to each item based on its index.
3. Verify that the lightbox functionality remains fully functional with the new grid layout.

## Success Criteria
- [ ] Figma design metrics are fully understood and mapped to Tailwind CSS classes.
- [ ] Responsive grid strategy is defined and verified.
