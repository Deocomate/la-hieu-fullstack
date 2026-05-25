<?php

declare(strict_types=1);

namespace App\Filament\Resources\SocialFeeds;

use App\Filament\Resources\SocialFeeds\Pages;
use App\Filament\Resources\SocialFeeds\Schemas\SocialFeedForm;
use App\Filament\Resources\SocialFeeds\Tables\SocialFeedsTable;
use App\Models\SocialFeed;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

final class SocialFeedResource extends Resource
{
    protected static ?string $model = SocialFeed::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-camera';

    protected static string|\UnitEnum|null $navigationGroup = 'Trang chủ';

    protected static ?string $navigationLabel = 'Mạng xã hội';

    protected static ?string $modelLabel = 'Bài viết mạng xã hội';

    protected static ?string $pluralModelLabel = 'Danh sách bài viết';

    protected static ?int $navigationSort = 30;

    public static function form(Schema $schema): Schema
    {
        return SocialFeedForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SocialFeedsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialFeeds::route('/'),
            'create' => Pages\CreateSocialFeed::route('/create'),
            'edit' => Pages\EditSocialFeed::route('/{record}/edit'),
        ];
    }
}
