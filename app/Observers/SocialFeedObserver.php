<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\SocialFeed;
use Illuminate\Support\Facades\Cache;

final class SocialFeedObserver
{
    public function saved(SocialFeed $socialFeed): void
    {
        Cache::forget('client.social_feeds');
    }

    public function deleted(SocialFeed $socialFeed): void
    {
        Cache::forget('client.social_feeds');
    }
}
