<?php

declare(strict_types=1);

namespace App\Filament\Resources\SocialFeeds\Pages;

use App\Filament\Resources\SocialFeeds\SocialFeedResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditSocialFeed extends EditRecord
{
    protected static string $resource = SocialFeedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
