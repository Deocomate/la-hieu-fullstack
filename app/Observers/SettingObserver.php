<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

final class SettingObserver
{
    public function saved(Setting $setting): void
    {
        Cache::forget('client.global_settings');
    }

    public function deleted(Setting $setting): void
    {
        Cache::forget('client.global_settings');
    }
}
