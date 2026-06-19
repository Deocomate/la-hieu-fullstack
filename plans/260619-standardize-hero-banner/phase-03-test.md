---
phase: 3
title: "Test"
status: pending
priority: P2
effort: "1h"
dependencies: ["2"]
---

# Phase 3: Test

## Overview
Verify all 8 pages render correctly, existing feature tests pass, and no style props remain in the codebase.

## Requirements
- Functional:
  - All index pages render title, bg text SVGs, optional subtitle/description.
  - All detail pages render title, date subtitle, bg text SVGs.
  - Lightbox/gallery sections below banner unaffected.
- Non-functional:
  - No references to deleted `hero-banner.blade.php`.
  - Responsive layout intact at mobile/tablet/desktop.

## Related Code Files
- Test: `tests/Feature/ClientPageDataBindingTest.php`
- Grep: confirm zero `hero-banner` includes remain

## Implementation Steps
1. Run `php artisan test --filter=ClientPageDataBindingTest`.
2. Grep codebase for `hero-banner`, `paddingTop`, `headingClass` in client views — expect zero matches.
3. Manual visual QA on all 8 pages:
   - `/event-photos`, `/event-photos/{slug}`
   - `/faces-and-places`, `/faces-and-places/{slug}`
   - `/photojournalism`, `/photojournalism/{slug}`
   - `/videography`, `/videography/{slug}`
4. Verify SVG background text renders for each section's `bgText` value.
5. Verify photojournalism/videography detail pages still show slider above text banner.

## Success Criteria
- [ ] `ClientPageDataBindingTest` passes.
- [ ] Zero grep matches for old `shared.hero-banner` include.
- [ ] Visual QA confirms index vs detail typography differences are consistent across all sections.
- [ ] No style props (`paddingTop`, `headingClass`, etc.) in any consumer blade file.

## Risk Assessment
| Risk | Mitigation |
|------|------------|
| Test doesn't cover hero markup | Add assertion for `hero-character-` SVG path in one index + one detail test if needed |
| Visual drift on event-photos index (was pt-[40px]) | Compare against Figma; adjust index-banner canonical padding if needed |
