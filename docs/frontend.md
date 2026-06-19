# Frontend (Blade)

## Layout

- **Layout:** `resources/views/components/layouts/main-client.blade.php`
- **Chrome:** `components/clients/chrome/` — `header`, `footer`, `styles`, `scripts`, `seo-meta`
- **Pages:** `resources/views/client/{section}/index|detail.blade.php` — thin shells with `@section('content')`
- **Sections:** `components/clients/pages/{domain}/` — home, about, contact, gallery blocks, etc.

## Component naming

Prefer Blade components over `@include`:

```blade
<x-clients.hero.index-banner :page="$page" />
<x-clients.article.list :list="$articles" card-layout="hover" />
<x-clients.gallery.detail-grid :images="$images" />
```

Domains: `chrome`, `hero`, `article`, `gallery`, `sections`, `ui`.

## Pagination

Default view is set in `AppServiceProvider`:

```php
Paginator::defaultView('components.clients.ui.pagination');
```

Use `{{ $list->links() }}` in list templates.

## Tooling

- **No Vite / npm** — see `.agents/rules/do-not-use-vite.md`
- Tailwind via CDN in `chrome/styles.blade.php`
- Swiper, AOS, PhotoSwipe via CDN in `chrome/scripts.blade.php` and `gallery/lightbox.blade.php`

## Admin routes

- Filament: `/admin`
- Custom authenticated routes: `routes/admin.php` under prefix `/admin-custom` with Filament `Authenticate` middleware
