<?php

declare(strict_types=1);

namespace App\Filament\Resources\SocialFeeds\Pages;

use App\Filament\Resources\SocialFeeds\SocialFeedResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListSocialFeeds extends ListRecords
{
    protected static string $resource = SocialFeedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
