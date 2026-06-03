<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;

final class PageObserver
{
    public function saved(Page $page): void
    {
        Cache::forget("page.{$page->key}");
    }

    public function deleted(Page $page): void
    {
        Cache::forget("page.{$page->key}");
    }
}
