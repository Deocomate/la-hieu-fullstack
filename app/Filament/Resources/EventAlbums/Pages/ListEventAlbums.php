<?php

declare(strict_types=1);

namespace App\Filament\Resources\EventAlbums\Pages;

use App\Filament\Resources\EventAlbums\EventAlbumResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListEventAlbums extends ListRecords
{
    protected static string $resource = EventAlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
