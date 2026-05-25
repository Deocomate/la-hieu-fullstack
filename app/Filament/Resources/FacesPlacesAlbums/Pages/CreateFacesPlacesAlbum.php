<?php

declare(strict_types=1);

namespace App\Filament\Resources\FacesPlacesAlbums\Pages;

use App\Filament\Resources\FacesPlacesAlbums\FacesPlacesAlbumResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateFacesPlacesAlbum extends CreateRecord
{
    protected static string $resource = FacesPlacesAlbumResource::class;
}
