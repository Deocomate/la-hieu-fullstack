<?php

declare(strict_types=1);

namespace App\Filament\Resources\EventAlbums\Pages;

use App\Filament\Resources\EventAlbums\EventAlbumResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

final class EditEventAlbum extends EditRecord
{
    protected static string $resource = EventAlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            RestoreAction::make(),
            ForceDeleteAction::make(),
        ];
    }
}
