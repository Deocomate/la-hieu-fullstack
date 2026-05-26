<?php

declare(strict_types=1);

namespace App\Filament\Resources\EventAlbums\Pages;

use App\Filament\Resources\EventAlbums\EventAlbumResource;
use Filament\Actions\Action;
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
