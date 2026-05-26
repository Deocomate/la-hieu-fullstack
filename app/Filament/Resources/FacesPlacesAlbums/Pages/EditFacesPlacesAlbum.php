<?php

declare(strict_types=1);

namespace App\Filament\Resources\FacesPlacesAlbums\Pages;

use App\Filament\Resources\FacesPlacesAlbums\FacesPlacesAlbumResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

final class EditFacesPlacesAlbum extends EditRecord
{
    protected static string $resource = FacesPlacesAlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')
                ->label('Xem trước')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->url(fn (): string => $this->record->getPreviewUrl())
                ->openUrlInNewTab(),
            DeleteAction::make(),
            RestoreAction::make(),
            ForceDeleteAction::make(),
        ];
    }
}
