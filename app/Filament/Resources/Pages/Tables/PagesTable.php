<?php

declare(strict_types=1);

namespace App\Filament\Resources\Pages\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Tên trang')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('key')
                    ->label('Mã trang')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('seo_title')
                    ->label('SEO Title')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Cập nhật lần cuối')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('title', 'asc')
            ->recordActions([
                Action::make('preview')
                    ->label('Xem trước')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn ($record): string => $record->getPreviewUrl())
                    ->openUrlInNewTab(),
                EditAction::make(),
            ]);
    }
}
