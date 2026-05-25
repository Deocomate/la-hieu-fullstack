<?php

declare(strict_types=1);

namespace App\Filament\Resources\EventAlbums;

use App\Filament\Resources\EventAlbums\Pages\CreateEventAlbum;
use App\Filament\Resources\EventAlbums\Pages\EditEventAlbum;
use App\Filament\Resources\EventAlbums\Pages\ListEventAlbums;
use App\Filament\Resources\EventAlbums\Schemas\EventAlbumForm;
use App\Filament\Resources\EventAlbums\Tables\EventAlbumsTable;
use App\Models\EventAlbum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

final class EventAlbumResource extends Resource
{
    protected static ?string $model = EventAlbum::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-camera';

    protected static string|\UnitEnum|null $navigationGroup = 'Thư viện Ảnh';

    protected static ?string $navigationLabel = 'Event Albums';

    protected static ?string $modelLabel = 'Album sự kiện';

    protected static ?string $pluralModelLabel = 'Danh sách album sự kiện';

    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return EventAlbumForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventAlbumsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEventAlbums::route('/'),
            'create' => CreateEventAlbum::route('/create'),
            'edit' => EditEventAlbum::route('/{record}/edit'),
        ];
    }
}
