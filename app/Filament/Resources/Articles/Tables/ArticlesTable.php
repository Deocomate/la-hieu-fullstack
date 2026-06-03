<?php

declare(strict_types=1);

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

final class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Ảnh đại diện')
                    ->disk('public'),
                TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Loại bài')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'photojournalism' => 'Photojournalism',
                        'videography' => 'Videography',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'photojournalism' => 'info',
                        'videography' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Danh mục')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->label('Nổi bật')
                    ->boolean()
                    ->sortable(),
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
                    })
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Ngày xuất bản')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('priority', 'asc')
            ->filters([
                SelectFilter::make('type')
                    ->label('Loại bài')
                    ->options([
                        'photojournalism' => 'Photojournalism',
                        'videography' => 'Videography',
                    ]),
                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'draft' => 'Nháp',
                        'published' => 'Đã xuất bản',
                        'hidden' => 'Đang ẩn',
                    ]),
                TernaryFilter::make('is_featured')
                    ->label('Bài viết nổi bật'),
                TrashedFilter::make(),
            ])
            ->recordActions([
                Action::make('preview')
                    ->label('Xem trước')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn ($record): string => $record->getPreviewUrl())
                    ->openUrlInNewTab(),
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ]);
    }
}
