---
phase: 2
title: "Implement"
status: pending
priority: P1
effort: "2h"
dependencies: ["1"]
---

# Phase 2: Implement

## Overview
Tạo 2 component mới (index + detail), extract shared bg-text partial, migrate 8 call sites sang data-only API, xóa component cũ.

## Requirements
- Functional:
  - `index-banner` nhận: `title`, `subtitle?`, `description?`, `bgText?`
  - `detail-banner` nhận: `title`, `subtitle?`, `bgText?`
  - Cả hai render SVG background text, heading, subtitle, gold divider.
  - `index-banner` render description block khi có `$description`.
- Non-functional:
  - Zero style props exposed to consumers.
  - DRY: bg-text logic chỉ ở một partial.

## Architecture

### File structure
```
resources/views/components/clients/hero/
├── index-banner.blade.php
├── detail-banner.blade.php
└── partials/
    └── bg-text.blade.php
```

### `bg-text.blade.php` (partial)
```blade
@php
    $bgTextString = strtoupper($bgText ?? $title ?? '');
    // ... existing specialCharsMap + foreach logic from hero-banner ...
@endphp
<div class="absolute top-0 left-1/2 -translate-x-1/2 w-max flex items-center gap-[5px] lg:gap-[15px] z-0 pointer-events-none select-none opacity-80">
    {{-- SVG chars loop --}}
</div>
```

### `index-banner.blade.php`
```blade
@props([
    'title',
    'subtitle' => null,
    'description' => null,
    'bgText' => null,
])

<section class="relative w-full bg-white overflow-hidden pt-[35px] lg:pt-[80px] pb-[20px] lg:pb-[80px] flex flex-col items-center">
    @include('components.clients.hero.partials.bg-text', ['bgText' => $bgText, 'title' => $title])

    <div class="relative z-10 w-full px-[35px] flex flex-col items-center">
        <h1 class="font-be-vietnam text-[36px] md:text-hero-lg font-extrabold tracking-[1.8px] md:tracking-normal text-black uppercase text-center break-words typing-effect">
            {{ $title }}
        </h1>

        @if ($subtitle)
            <p class="font-be-vietnam text-body-16-norm font-thin mt-[5px] text-black text-center break-words" data-aos="fade-up" data-aos-delay="200">
                {{ $subtitle }}
            </p>
        @endif

        <div class="w-[2px] h-[38px] bg-[#C5AA82] mt-[22px]" data-aos="fade-up" data-aos-delay="300"></div>

        @if ($description)
            <p class="font-be-vietnam font-light text-[14px] text-black text-center leading-[22px] max-w-[430px] mt-[24px] mb-8 lg:mb-[47px]" data-aos="fade-up" data-aos-delay="400">
                {{ $description }}
            </p>
        @endif
    </div>
</section>
```

### `detail-banner.blade.php`
Same structure but detail canonical classes; no description block.

**Empty subtitle guard (validated):** Wrap subtitle + gold divider trong `@if ($subtitle)` — ẩn cả hai khi rỗng.

### Migration example — `event-photos/detail.blade.php`

**Before:**
```blade
@include('components.clients.shared.hero-banner', [
    'title' => $album->title,
    'subtitle' => $album->event_date?->format('jS F Y') ?? '',
    'paddingTop' => 'pt-[35px] lg:pt-[80px]',
    'paddingBottom' => 'pb-[30px] lg:pb-[80px]',
    'headingClass' => 'text-[24px] md:text-hero-md font-extrabold md:font-bold tracking-[1.2px] md:tracking-normal',
    'subtitleClass' => 'text-[14px] md:text-body-16-norm font-normal md:font-light',
    'bgText' => $album->hero_bg_text ?? 'EVENT PHOTOS',
])
```

**After:**
```blade
<x-clients.hero.detail-banner
    :title="$album->title"
    :subtitle="$album->event_date?->format('jS F Y') ?? ''"
    :bg-text="$album->hero_bg_text ?? 'EVENT PHOTOS'"
/>
```

## Related Code Files
- Create: `resources/views/components/clients/hero/partials/bg-text.blade.php`
- Create: `resources/views/components/clients/hero/index-banner.blade.php`
- Create: `resources/views/components/clients/hero/detail-banner.blade.php`
- Modify: 8 consumer blade files (4 index + 4 detail)
- Delete: `resources/views/components/clients/shared/hero-banner.blade.php`

## Implementation Steps
1. Create `hero/partials/bg-text.blade.php` — extract SVG logic from old component.
2. Create `hero/index-banner.blade.php` with baked index styles.
3. Create `hero/detail-banner.blade.php` with baked detail styles.
4. Migrate 4 index pages — remove all style props.
5. Migrate 4 detail pages — remove all style props.
6. Delete `shared/hero-banner.blade.php`.
7. Run `php artisan view:clear` to flush compiled views.

## Success Criteria
- [ ] 2 new components exist with data-only `@props`.
- [ ] All 8 call sites migrated to `<x-clients.hero.*>` — zero references to old `hero-banner`.
- [ ] Old component deleted.
- [ ] Detail banner hides subtitle + divider when subtitle is empty.
- [ ] No `paddingTop`, `paddingBottom`, `headingClass`, `subtitleClass` passed from any page.

## Risk Assessment
| Risk | Mitigation |
|------|------------|
| Blade component not found | Follow existing namespace `x-clients.*`; verify with `php artisan view:cache` |
| Subtitle empty renders empty `<p>` | Use `@if ($subtitle)` guard — hide subtitle AND divider (validated) |
