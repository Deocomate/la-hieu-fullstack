<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\SocialFeed;
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
        View::composer('components.clients.follow-section', function ($view): void {
            $socialFeeds = Cache::remember('client.social_feeds', 3600, function () {
                return SocialFeed::published()
                    ->ordered()
                    ->take(10)
                    ->get();
            });

            $view->with('socialFeeds', $socialFeeds);
        });

        View::composer([
            'components.clients.footer',
            'client.contact.partials.contact-main-section',
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
