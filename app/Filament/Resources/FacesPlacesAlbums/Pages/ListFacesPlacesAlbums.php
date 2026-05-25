<?php

declare(strict_types=1);

namespace App\Filament\Resources\FacesPlacesAlbums\Pages;

use App\Filament\Resources\FacesPlacesAlbums\FacesPlacesAlbumResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListFacesPlacesAlbums extends ListRecords
{
    protected static string $resource = FacesPlacesAlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
