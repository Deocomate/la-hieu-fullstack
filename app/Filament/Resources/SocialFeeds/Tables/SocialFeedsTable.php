<?php

declare(strict_types=1);

namespace App\Filament\Resources\SocialFeeds\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class SocialFeedsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Ảnh feed'),
                TextColumn::make('platform')
                    ->label('Nền tảng')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'instagram' => 'Instagram',
                        'facebook' => 'Facebook',
                        'tiktok' => 'TikTok',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'instagram' => 'primary',
                        'facebook' => 'info',
                        'tiktok' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('post_url')
                    ->label('Đường dẫn bài viết')
                    ->openUrlInNewTab()
                    ->searchable(),
                TextColumn::make('priority')
                    ->label('Thứ tự')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Nháp',
                        'published' => 'Đã xuất bản',
                        'hidden' => 'Đang ẩn',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'hidden' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('priority', 'asc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'draft' => 'Nháp',
                        'published' => 'Đã xuất bản',
                        'hidden' => 'Đang ẩn',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
