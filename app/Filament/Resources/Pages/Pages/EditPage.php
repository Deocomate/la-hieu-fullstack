<?php

declare(strict_types=1);

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

final class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')
                ->label('Xem trước')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->url(fn (): string => $this->record->getPreviewUrl())
                ->openUrlInNewTab(),
        ];
    }
}
