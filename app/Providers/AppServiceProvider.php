<?php

namespace App\Providers;

use App\Models\Media;
use App\Models\Page;
use App\Models\Setting;
use App\Models\SocialFeed;
use App\Observers\MediaObserver;
use App\Observers\PageObserver;
use App\Observers\SettingObserver;
use App\Observers\SocialFeedObserver;
use App\Support\Seo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('components.clients.ui.pagination');

        Setting::observe(SettingObserver::class);
        SocialFeed::observe(SocialFeedObserver::class);
        Page::observe(PageObserver::class);
        Media::observe(MediaObserver::class);

        View::composer('components.layouts.main-client', function ($view): void {
            $data = $view->getData();

            $model = $data['article']
                ?? $data['album']
                ?? $data['page']
                ?? null;

            $settings = Cache::rememberForever('client.global_settings', function (): array {
                return Setting::query()
                    ->pluck('value', 'key')
                    ->all();
            });

            $view->with('seo', Seo::fromModel($model, $settings));
        });

        View::composer('components.clients.sections.follow', function ($view): void {
            $socialFeeds = Cache::remember('client.social_feeds', 3600, function () {
                return SocialFeed::published()
                    ->ordered()
                    ->take(10)
                    ->get();
            });

            $view->with('socialFeeds', $socialFeeds);
        });

        View::composer([
            'components.clients.chrome.footer',
            'components.clients.pages.contact.main',
        ], function ($view): void {
            $settings = Cache::rememberForever('client.global_settings', function (): array {
                return Setting::query()
                    ->pluck('value', 'key')
                    ->all();
            });

            $view->with('settings', $settings);
        });
    }
}
