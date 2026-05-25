<?php

declare(strict_types=1);

namespace App\Filament\Resources\FacesPlacesAlbums;

use App\Filament\Resources\FacesPlacesAlbums\Pages\CreateFacesPlacesAlbum;
use App\Filament\Resources\FacesPlacesAlbums\Pages\EditFacesPlacesAlbum;
use App\Filament\Resources\FacesPlacesAlbums\Pages\ListFacesPlacesAlbums;
use App\Filament\Resources\FacesPlacesAlbums\Schemas\FacesPlacesAlbumForm;
use App\Filament\Resources\FacesPlacesAlbums\Tables\FacesPlacesAlbumsTable;
use App\Models\FacesPlacesAlbum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

final class FacesPlacesAlbumResource extends Resource
{
    protected static ?string $model = FacesPlacesAlbum::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-map-pin';

    protected static string|\UnitEnum|null $navigationGroup = 'Thư viện Ảnh';

    protected static ?string $navigationLabel = 'Faces & Places';

    protected static ?string $modelLabel = 'Album Faces & Places';

    protected static ?string $pluralModelLabel = 'Danh sách Faces & Places';

    protected static ?int $navigationSort = 20;

    public static function form(Schema $schema): Schema
    {
        return FacesPlacesAlbumForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FacesPlacesAlbumsTable::configure($table);
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
            'index' => ListFacesPlacesAlbums::route('/'),
            'create' => CreateFacesPlacesAlbum::route('/create'),
            'edit' => EditFacesPlacesAlbum::route('/{record}/edit'),
        ];
    }
}
