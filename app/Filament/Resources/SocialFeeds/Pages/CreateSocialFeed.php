<?php

declare(strict_types=1);

namespace App\Filament\Resources\SocialFeeds\Pages;

use App\Filament\Resources\SocialFeeds\SocialFeedResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateSocialFeed extends CreateRecord
{
    protected static string $resource = SocialFeedResource::class;
}
