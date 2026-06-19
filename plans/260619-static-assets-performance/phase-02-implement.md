---
phase: 2
title: "Implement"
status: pending
priority: P1
effort: "1d"
dependencies: [1]
---

# Phase 2: Implement

## Overview

Thực hiện 5 workstream: migrate static assets, simplify ClientImage, wire SEO meta, default pagination, fix admin middleware. Image optimization (WS-6) là optional extension.

## Requirements

- Functional: Static files served without PHP; uploads via `/storage/` symlink
- Functional: SEO meta tags on all client pages
- Non-functional: Zero `file_exists()` in hot path (`ClientImage`)
- Non-functional: Backward compat không cần thiết — clean break `client/assets` → `assets`

## Architecture

### WS-1: Asset migration + route removal

**Step 1 — Move directories**

```powershell
# From project root
New-Item -ItemType Directory -Force public/assets
git mv public/client/assets/static public/assets/static
git mv public/client/assets/fonts public/assets/fonts
git mv public/client/assets/js public/assets/js
# Remove empty public/client/assets if empty
```

**Step 2 — Consolidate storage duplicates**

Copy any PNG/JPG in `storage/app/public/client/assets/static/` that are NOT yet in `public/assets/static/` (design assets only). Then delete `storage/app/public/client/`.

**Step 3 — Global path replace**

```powershell
# Replace in source (exclude plans/, storage/framework/, vendor/)
rg -l "client/assets" --glob "!plans/**" --glob "!vendor/**" --glob "!storage/framework/**" | ForEach-Object {
  (Get-Content $_) -replace 'client/assets/', 'assets/' | Set-Content $_
}
```

Verify: `rg "client/assets"` → 0 matches in `resources/`, `app/`, `database/`, `tests/`, `public/`.

**Step 4 — Delete PHP fallback routes**

Remove from `routes/web.php`:

```php
// DELETE both closures:
Route::get('storage/{path}', ...);
Route::get('client/assets/{path}', ...);
```

**Step 5 — Ensure storage symlink**

Document in README / deploy notes:
```bash
php artisan storage:link
```

### WS-2: ClientImage refactor

**Modify:** `app/Support/ClientImage.php`

```php
final class ClientImage
{
    public static function url(?string $path, ?string $fallback = null): string
    {
        $path = trim((string) ($path ?: $fallback));

        if ($path === '') {
            return '';
        }

        if (
            Str::startsWith($path, ['http://', 'https://', '//', '/'])
            || Str::startsWith($path, 'data:')
        ) {
            return $path;
        }

        if (Str::startsWith($path, 'assets/')) {
            return asset($path);
        }

        return Storage::disk('public')->url($path);
    }
}
```

**Key changes:**
- Removed `file_exists(public_path($path))` — zero disk I/O
- Removed special `.svg` branch — all `assets/` paths use `asset()`
- Upload paths (`articles/covers/foo.jpg`) → `Storage::url()` unchanged

**Optional:** Add `ClientImage::isStatic(string $path): bool` only if needed elsewhere — YAGNI, skip unless required.

### WS-3: SEO meta component (View Composer approach)

<!-- Updated: Validation Session 1 - SEO via View Composer instead of inline @php -->

**Create:** `resources/views/components/clients/chrome/seo-meta.blade.php`

```blade
@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'url' => null,
    'type' => 'website',
])

@php
    $resolvedTitle = $title ?: config('app.name');
    $resolvedDescription = $description ?: '';
    $resolvedImage = $image ? \App\Support\ClientImage::url($image) : '';
    $resolvedUrl = $url ?: url()->current();
@endphp

<title>{{ $resolvedTitle }}</title>
<meta name="description" content="{{ $resolvedDescription }}">
<link rel="canonical" href="{{ $resolvedUrl }}">

<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $resolvedTitle }}">
<meta property="og:description" content="{{ $resolvedDescription }}">
<meta property="og:url" content="{{ $resolvedUrl }}">
@if ($resolvedImage)
<meta property="og:image" content="{{ $resolvedImage }}">
@endif

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $resolvedTitle }}">
<meta name="twitter:description" content="{{ $resolvedDescription }}">
@if ($resolvedImage)
<meta name="twitter:image" content="{{ $resolvedImage }}">
@endif
```

**Create:** `app/Support/Seo.php` (thin helper)

```php
final class Seo
{
    public static function fromModel(?object $model, ?array $settings = null): array
    {
        $settings ??= [];

        return [
            'title' => $model?->seo_title ?: $model?->title ?? config('app.name'),
            'description' => $model?->seo_description ?? '',
            'image' => $model?->seo_image ?: ($settings['seo_default_image'] ?? null),
        ];
    }
}
```

**Modify:** `app/Providers/AppServiceProvider.php` — add View Composer

```php
View::composer('components.layouts.main-client', function ($view): void {
    $data = $view->getData();

    $model = $data['article']
        ?? $data['album']
        ?? $data['page']
        ?? null;

    $settings = Cache::rememberForever('client.global_settings', function (): array {
        return Setting::query()->pluck('value', 'key')->all();
    });

    $view->with('seo', Seo::fromModel($model, $settings));
});
```

**Modify:** `resources/views/components/layouts/main-client.blade.php`

```blade
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-clients.chrome.seo-meta
        :title="$seo['title'] ?? null"
        :description="$seo['description'] ?? null"
        :image="$seo['image'] ?? null"
    />
    <x-clients.chrome.styles />
    @stack('styles')
</head>
```

**Remove** `@section('title', ...)` từ tất cả `resources/views/client/**/*.blade.php` — SEO component thay thế.

**Update:** `database/seeders/SettingSeeder.php` — `seo_default_image` path → `assets/static/home/hero-image.png`

### WS-4: Pagination default

**Modify:** `app/Providers/AppServiceProvider.php`

```php
use Illuminate\Pagination\Paginator;

public function boot(): void
{
    Paginator::defaultView('components.clients.ui.pagination');
    // ... existing observers/composers
}
```

**Modify:** `resources/views/components/clients/article/list.blade.php`

```blade
{{-- Before --}}
{{ $list->links('components.clients.ui.pagination') }}

{{-- After --}}
{{ $list->links() }}
```

### WS-5: Admin auth middleware

**Modify:** `bootstrap/app.php`

```php
use Filament\Http\Middleware\Authenticate;

Route::middleware(['web', Authenticate::class])
    ->prefix('admin-custom')
    ->name('admin.')
    ->group(base_path('routes/admin.php'));
```

Remove generic `'auth'` alias — dùng Filament middleware giống `AdminPanelProvider`.

### WS-6: Image optimization (REQUIRED — validation confirmed full scope)

<!-- Updated: Validation Session 1 - include upload hook + backfill command -->

**Step 1 — Install package**

```bash
composer require spatie/laravel-image-optimizer
```

**Step 2 — Create upload optimizer service**

**Create:** `app/Services/ImageOptimizer.php`

```php
final class ImageOptimizer
{
    public function optimize(string $absolutePath): void
    {
        if (! file_exists($absolutePath)) {
            return;
        }
        app(\Spatie\LaravelImageOptimizer\OptimizerChain::class)->optimize($absolutePath);
    }

    public function generateWebp(string $absolutePath): ?string
    {
        // GD/Imagick: create {name}.webp alongside original
        // Return relative storage path or null on failure
    }
}
```

**Step 3 — Hook Filament uploads**

Option A (recommended): Model Observer on `Media` create/update — optimize `storage_path('app/public/' . $path)`.

Option B: Shared trait/method called from Filament `afterStateUpdated` on FileUpload fields.

**Step 4 — Backfill command**

**Create:** `app/Console/Commands/OptimizeExistingImages.php`

```bash
php artisan images:optimize-existing [--dry-run] [--disk=public]
```

- Scan `storage/app/public/{articles,partners,pages,event_albums,faces_places_albums,social_feeds}/`
- Skip `assets/` paths (design static, already in public/)
- Run optimizer + generate WebP variants
- Log processed/skipped/failed counts

**Step 5 — Config**

Publish `config/image-optimizer.php` if needed. Document binary dependencies (jpegoptim, pngquant, cwebp) for production server.

## Related Code Files

- Delete logic: `routes/web.php` (lines 50–72)
- Move: `public/client/assets/*` → `public/assets/*`
- Modify: `app/Support/ClientImage.php`
- Create: `app/Support/Seo.php`
- Create: `resources/views/components/clients/chrome/seo-meta.blade.php`
- Modify: `resources/views/components/layouts/main-client.blade.php`
- Modify: `app/Providers/AppServiceProvider.php`
- Modify: `bootstrap/app.php`
- Modify: all `resources/views/client/**/*.blade.php` (SEO + path if missed by rg)
- Modify: `database/seeders/*.php`, `database/factories/*.php`
- Modify: `tests/Feature/FilamentResourceTest.php`
- Modify: `resources/views/components/clients/gallery/lightbox.blade.php` (JS path)

## Implementation Steps

1. WS-1: Move asset dirs + global replace + delete routes
2. WS-2: Refactor `ClientImage`
3. WS-3: Create `Seo` helper + `seo-meta` component + View Composer on layout
4. WS-4: `Paginator::defaultView` + simplify `links()` calls
5. WS-5: Filament `Authenticate` on admin-custom
6. WS-6: Install spatie optimizer + upload hook + `images:optimize-existing` command
7. Remove `@section('title')` from all client views
8. Run `php artisan view:clear && php artisan test`
9. Run `php artisan images:optimize-existing --dry-run` to verify backfill scope
10. Manual smoke: home, 1 gallery detail, 1 article detail — check Network tab (no PHP for images)

## Success Criteria

- [ ] `rg "client/assets"` → 0 in source (excl. plans, vendor)
- [ ] `rg "file_exists" app/Support/ClientImage.php` → 0
- [ ] `routes/web.php` has no static file closures
- [ ] All client pages render `<meta name="description">` with DB content
- [ ] `og:image` present when `seo_image` set
- [ ] Pagination renders with `{{ $list->links() }}` only
- [ ] `admin-custom` routes protected by Filament Authenticate
- [ ] `php artisan images:optimize-existing --dry-run` completes without errors
- [ ] New uploads trigger optimization (verify via test or manual Filament upload)

## Risk Assessment

| Risk | Mitigation |
|------|------------|
| Missed blade path after rg | Final `rg "client/assets"` gate |
| SEO title empty on detail | Fallback chain: `seo_title` → `title` → `config('app.name')` |
| OG image relative URL | `ClientImage::url()` ensures absolute URL in meta |
| Test failures on removed routes | Rewrite `test_fallback_image_routes_*` → test direct public access |
