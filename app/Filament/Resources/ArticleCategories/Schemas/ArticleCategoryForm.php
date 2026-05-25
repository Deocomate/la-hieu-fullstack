<?php

declare(strict_types=1);

namespace App\Filament\Resources\ArticleCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

final class ArticleCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Tên danh mục')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function (?string $old, ?string $state, Get $get, Set $set): void {
                    $slug = (string) $get('slug');

                    if (filled($slug) && $slug !== Str::slug((string) $old)) {
                        return;
                    }

                    $set('slug', Str::slug((string) $state));
                })
                ->maxLength(255),
            TextInput::make('slug')
                ->label('Đường dẫn tĩnh')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
        ]);
    }
}
