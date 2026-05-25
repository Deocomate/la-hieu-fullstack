<?php

declare(strict_types=1);

namespace App\Filament\Resources\SocialFeeds\Pages;

use App\Filament\Resources\SocialFeeds\SocialFeedResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

final class EditSocialFeed extends EditRecord
{
    protected static string $resource = SocialFeedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->after(fn (): bool => Cache::forget('client.social_feeds')),
        ];
    }

    protected function afterSave(): void
    {
        Cache::forget('client.social_feeds');
    }
}
