# Assets & Performance

## Static design assets

Design-time files (icons, hero images, fonts, client JS) live under `public/assets/`:

```text
public/assets/
├── static/    # Images & SVGs bundled with the theme
├── fonts/     # Be Vietnam, Archivo
└── js/        # gallery-lightbox.js
```

URLs use the `assets/` prefix, e.g. `/assets/static/home/hero-image.png`.

**Do not** add Laravel routes to serve these files. Nginx, Apache, or `php artisan serve` reads them directly from `public/`.

## Admin uploads

Filament `FileUpload` fields store paths relative to the `public` disk, e.g.:

- `articles/covers/…`
- `event_albums/gallery/…`
- `partners/…`

Serve via the storage symlink:

```bash
php artisan storage:link
```

Public URL: `/storage/{path}`.

## `ClientImage::url()`

Single resolver for Blade and helpers:

| DB / path prefix | Resolved URL |
|------------------|--------------|
| `assets/…` | `asset('assets/…')` |
| `articles/…`, `partners/…`, etc. | `Storage::disk('public')->url($path)` |
| `http(s)://…`, `/…`, `data:…` | unchanged |

No `file_exists()` checks at render time — convention only.

## Image optimization

On upload, `MediaObserver` runs `App\Services\ImageOptimizer` (Spatie + optional WebP via GD).

Backfill existing uploads:

```bash
php artisan images:optimize-existing --dry-run
php artisan images:optimize-existing
```

Production optional binaries: `jpegoptim`, `pngquant`, `optipng`, `cwebp`.

## Upgrading from `client/assets/` paths

If the database still has old paths (`client/assets/static/…`):

```bash
php artisan assets:migrate-paths --dry-run
php artisan assets:migrate-paths
```

Run once after pulling the static-assets migration, then clear caches if needed:

```bash
php artisan cache:clear
php artisan view:clear
```

## SEO meta

`App\Support\Seo` + View Composer on `components.layouts.main-client` inject `$seo` from `$page`, `$article`, or `$album`. Rendered by `<x-clients.chrome.seo-meta />`.
