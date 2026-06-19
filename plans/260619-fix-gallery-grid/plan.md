---
title: "Fix Gallery Grid Design"
description: "Align the detail gallery grid section in the Faces & Places and Event Photos detail pages with the Figma design using a responsive 12-column alternating grid."
status: completed
priority: P2
branch: "main"
tags: ["frontend", "figma", "grid"]
blockedBy: []
blocks: []
created: "2026-06-19T09:50:14.451Z"
createdBy: "ck:plan"
source: skill
---

# Fix Gallery Grid Design

## Overview
The gallery grid section on the Event Photos detail page and the Faces & Places detail page does not match the Figma design. Currently, it uses a simple multi-column masonry layout (`columns-2 lg:columns-3`). The Figma design specifies an alternating horizontal grid of wide and narrow items of equal height (340px) on desktop:
- **Row 1:** Wide (500px), Narrow (242px), Wide (497px), Narrow (242px)
- **Row 2:** Narrow (218px), Wide (502px), Narrow (183px), Wide (497px)

This plan outlines how to refactor the shared `detail-gallery-grid.blade.php` component using a responsive Tailwind CSS 12-column grid layout that perfectly matches the Figma design on desktop while maintaining a beautiful, fluid masonry layout on mobile and tablet.

## Phases

| Phase | Name | Status |
|-------|------|--------|
| 1 | [Research](./phase-01-research.md) | Completed |
| 2 | [Implement](./phase-02-implement.md) | Completed |
| 3 | [Test](./phase-03-test.md) | Completed |

## Dependencies
None. This is a standalone frontend layout fix.

## Validation Log

### Session 1 — 2026-06-19
**Trigger:** User requested validation of the plan to fix the gallery grid design.
**Questions asked:** 3

#### Questions & Answers

1. **[Assumptions]** How should we handle cases where the number of images in the album is not a multiple of 8?
   - Options: Let the grid wrap naturally, maintaining the alternating pattern (Recommended) | Pad the images with static placeholders to always fill complete rows of 8 | Hide the trailing images that do not fit a complete set of 8
   - **Answer:** Let the grid wrap naturally, maintaining the alternating pattern (Recommended)
   - **Rationale:** This ensures that all images are displayed without introducing artificial filler content or hiding real album content.

2. **[Architecture]** On mobile and tablet devices, what layout should we use?
   - Options: Keep the existing fluid masonry layout (columns-2 md:columns-3) for optimal presentation of vertical/horizontal images without cropping (Recommended) | Force the 12-column grid layout on all screen sizes, scaling down the images and heights | Use a simple 2-column grid with equal aspect ratios (1:1)
   - **Answer:** Keep the existing fluid masonry layout (columns-2 md:columns-3) for optimal presentation of vertical/horizontal images without cropping (Recommended)
   - **Rationale:** Masonry columns are highly responsive and display vertical and horizontal photos beautifully on smaller screens without awkward cropping or tiny aspect ratios.

3. **[Assumptions]** How should we handle image aspect ratios and cropping on desktop?
   - Options: Use object-cover so they fill the 340px height grid cells perfectly, cropping if necessary (Recommended) | Use object-contain to show the entire image without cropping, leaving letterboxing/pillarboxing | Let the height of each row be dynamic based on the tallest image in that row
   - **Answer:** Use object-cover so they fill the 340px height grid cells perfectly, cropping if necessary (Recommended)
   - **Rationale:** This ensures a clean, uniform, and pixel-perfect grid layout matching the Figma design's heights without letterboxing or uneven rows.

#### Confirmed Decisions
- **Dynamic Image Counts:** Let the grid wrap naturally, maintaining the alternating pattern.
- **Mobile/Tablet Layout:** Keep the existing fluid masonry layout (columns-2 md:columns-3).
- **Desktop Aspect Ratio:** Use object-cover with a fixed height of 340px to ensure pixel-perfect alignment.

#### Action Items
- [ ] Implement alternating column spans and heights in `detail-gallery-grid.blade.php`.
- [ ] Ensure mobile and tablet masonry columns are preserved.
- [ ] Verify lightbox integration with the new layout.

#### Impact on Phases
- Phase 2: Implementation steps will use the confirmed alternating 12-column grid classes and keep the mobile masonry columns.

### Verification Results
- **Tier:** Standard
- **Claims checked:** 4
- **Verified:** 4 | **Failed:** 0 | **Unverified:** 0

### Whole-Plan Consistency Sweep
- Files reread: plan.md, phase-01-research.md, phase-02-implement.md, phase-03-test.md
- Decision deltas checked: 3
- Reconciled stale references: 0
- Unresolved contradictions: 0
