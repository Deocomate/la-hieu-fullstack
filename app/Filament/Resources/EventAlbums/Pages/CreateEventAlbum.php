<?php

declare(strict_types=1);

namespace App\Filament\Resources\EventAlbums\Pages;

use App\Filament\Resources\EventAlbums\EventAlbumResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateEventAlbum extends CreateRecord
{
    protected static string $resource = EventAlbumResource::class;
}
