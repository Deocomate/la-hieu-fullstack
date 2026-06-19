---
phase: 3
title: "Test"
status: pending
priority: P1
effort: "3h"
dependencies: [2]
---

# Phase 3: Test

## Overview

Cập nhật test suite, chạy regression, và smoke test performance/SEO trên tất cả page types. Xác nhận static files không đi qua PHP.

## Requirements

- Functional: All Pest tests pass
- Functional: Static assets return 200 via direct URL (not Laravel route)
- Functional: SEO meta assertions per page type
- Non-functional: Gallery page không trigger `file_exists` (verify via code, not runtime profiling)

## Architecture

### Test updates required

| Test file | Change |
|-----------|--------|
| `tests/Feature/FilamentResourceTest.php` | Remove/replace `test_fallback_image_routes_work_and_prevent_path_traversal` |
| `tests/Feature/FilamentResourceTest.php` | Update `test_client_image_url_helper_distributes_assets_correctly` |
| `tests/Feature/ClientPageDataBindingTest.php` | Update hardcoded `client/assets/...` paths |
| `tests/Unit/GalleryImageTest.php` | Update test paths to `assets/static/...` |

### New tests to add

**Create:** `tests/Unit/ClientImageTest.php`

```php
it('resolves static assets via asset helper', function () {
    $url = ClientImage::url('assets/static/home/hero-logo.svg');
    expect($url)->toBe(asset('assets/static/home/hero-logo.svg'));
});

it('resolves uploads via storage disk', function () {
    $url = ClientImage::url('articles/covers/photo.jpg');
    expect($url)->toBe(Storage::disk('public')->url('articles/covers/photo.jpg'));
});

it('passes through absolute urls', function () {
    $url = ClientImage::url('https://example.com/img.jpg');
    expect($url)->toBe('https://example.com/img.jpg');
});

it('uses fallback when path is empty', function () {
    $url = ClientImage::url(null, 'assets/static/home/hero.png');
    expect($url)->toBe(asset('assets/static/home/hero.png'));
});
```

**Create:** `tests/Feature/SeoMetaTest.php`

```php
it('renders seo meta tags on home page', function () {
    $page = Page::factory()->create([
        'key' => 'home',
        'seo_title' => 'Test SEO Title',
        'seo_description' => 'Test description for search engines.',
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('<meta name="description" content="Test description for search engines."', false)
        ->assertSee('<meta property="og:title" content="Test SEO Title"', false);
});

it('renders article seo on detail page', function () {
    $article = Article::factory()->photojournalism()->published()->create([
        'seo_title' => 'Article SEO',
        'seo_description' => 'Article desc',
    ]);

    $this->get(route('photojournalism.show', $article->slug))
        ->assertOk()
        ->assertSee('Article SEO', false)
        ->assertSee('Article desc', false);
});
```

**Replace fallback route test** with static file access test:

```php
it('serves static assets directly from public without php route', function () {
    $this->get('/assets/static/home/hero-logo.svg')
        ->assertOk();
    // Should NOT match named Laravel routes
    expect(Route::getRoutes()->match(Request::create('/assets/static/home/hero-logo.svg'))->getAction())
        ->not->toContain('Closure');
});
```

Note: `artisan serve` serves static files before routing — assertion is HTTP 200 + correct content-type.

## Related Code Files

- Modify: `tests/Feature/FilamentResourceTest.php`
- Modify: `tests/Feature/ClientPageDataBindingTest.php`
- Modify: `tests/Unit/GalleryImageTest.php`
- Create: `tests/Unit/ClientImageTest.php`
- Create: `tests/Feature/SeoMetaTest.php`

## Implementation Steps

1. Update all test fixtures using `client/assets/` paths
2. Rewrite/remove fallback route tests
3. Add `ClientImageTest` unit tests
4. Add `SeoMetaTest` feature tests
5. Run full suite: `php artisan test`
6. Manual smoke checklist (browser):

| URL | Check |
|-----|-------|
| `/` | Hero images load, view-source has og:meta |
| `/about` | SEO description from Page model |
| `/event-photos/{slug}` | Gallery 20+ images, Network tab shows `/assets/` or `/storage/` (not 404) |
| `/photojournalism` | Pagination works (prev/next SVG from `/assets/static/components/`) |
| `/photojournalism/{slug}` | Article SEO meta |
| `/admin-custom/custom-dashboard` | 302 to login when unauthenticated |

7. Verify no PHP route for assets:
   ```powershell
   php artisan route:list | Select-String "client/assets|storage/\{"
   ```
   Expected: no matches

8. Performance sanity: gallery detail page — confirm response time không scale linearly với số ảnh do bỏ `file_exists`

9. Image optimization tests:

```php
it('optimizes image on media create', function () {
    // Create Media with test image, assert optimizer called or file size reduced
});

it('images optimize existing command runs dry run', function () {
    $this->artisan('images:optimize-existing', ['--dry-run' => true])
        ->assertSuccessful();
});
```

10. View Composer SEO test — home page without explicit `$seo` in view:

```php
it('view composer injects seo from page model', function () {
    Page::factory()->create(['key' => 'home', 'seo_title' => 'Composer SEO']);
    $this->get('/')->assertSee('Composer SEO', false);
});
```

## Success Criteria

- [ ] `php artisan test` — all green
- [ ] `php artisan route:list` — no static file closure routes
- [ ] `rg "client/assets" tests/` — 0 matches
- [ ] Home + 1 detail page have correct OG tags in view-source
- [ ] Gallery images load without 404
- [ ] Pagination prev/next icons load from `/assets/static/components/`
- [ ] Unauthenticated `/admin-custom/*` redirects to Filament login
- [ ] `php artisan images:optimize-existing --dry-run` passes in CI
- [ ] SEO View Composer injects meta without per-view `@php` blocks

## Risk Assessment

- **Flaky SEO tests** due to HTML encoding — use `assertSee(..., false)` for raw HTML or `assertSeeText` for content only
- **artisan serve vs Nginx** behavior difference — document that production uses Nginx `try_files`
- **Cached views** after path change — run `php artisan view:clear` before test
