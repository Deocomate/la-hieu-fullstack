<?php

declare(strict_types=1);

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

final class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group')
                    ->label('Nhóm')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'general' => 'Cài đặt chung',
                        'contact' => 'Thông tin liên hệ',
                        'social' => 'Mạng xã hội',
                        'footer' => 'Chân trang (Footer)',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'general' => 'primary',
                        'contact' => 'info',
                        'social' => 'warning',
                        'footer' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('key')
                    ->label('Mã cài đặt')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Giá trị')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->label('Cập nhật lúc')
                    ->dateTime()
                    ->sortable(),
            ])
            ->groups([
                Group::make('group')
                    ->label('Nhóm cài đặt')
                    ->collapsible(),
            ])
            ->defaultGroup('group')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
