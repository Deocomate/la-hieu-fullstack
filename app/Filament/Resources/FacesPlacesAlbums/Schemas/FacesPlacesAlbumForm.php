<?php

declare(strict_types=1);

namespace App\Filament\Resources\FacesPlacesAlbums\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use App\Filament\Schemas\Components\SeoTab;
use App\Support\MediaProcessor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

final class FacesPlacesAlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('FacesPlacesAlbumTabs')
                ->tabs([
                    Tab::make('Thông tin chung & Ảnh')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Section::make('Thông tin bộ sưu tập')
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Tên bộ sưu tập')
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
                                    Textarea::make('description')
                                        ->label('Mô tả ngắn')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                    TextInput::make('hero_bg_text')
                                        ->label('Chữ nền phía sau')
                                        ->maxLength(100),
                                    FileUpload::make('cover_image')
                                        ->label('Ảnh đại diện')
                                        ->disk('public')
                                        ->directory('faces_places_albums/covers')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('priority')
                                        ->label('Thứ tự hiển thị')
                                        ->numeric()
                                        ->default(0)
                                        ->required(),
                                    ToggleButtons::make('status')
                                        ->label('Trạng thái')
                                        ->options(self::statusOptions())
                                        ->colors(self::statusColors())
                                        ->icons(self::statusIcons())
                                        ->default('published')
                                        ->inline()
                                        ->required(),
                                ])->columns(2),

                            Section::make('Thư viện ảnh')
                                ->schema([
                                    Repeater::make('media')
                                        ->label('Danh sách ảnh')
                                        ->relationship(
                                            modifyQueryUsing: fn (Builder $query): Builder => $query
                                                ->where('collection_name', 'gallery')
                                                ->orderBy('priority'),
                                        )
                                        ->orderColumn('priority')
                                        ->schema([
                                            FileUpload::make('file_url')
                                                ->label('Ảnh')
                                                ->disk('public')
                                                ->directory('faces_places_albums/gallery')
                                                ->image()
                                                ->imageEditor()
                                                ->required(),
                                        ])
                                        ->mutateRelationshipDataBeforeCreateUsing(fn (array $data): array => MediaProcessor::prepare($data, 'gallery'))
                                        ->mutateRelationshipDataBeforeSaveUsing(fn (array $data): array => MediaProcessor::prepare($data, 'gallery'))
                                        ->addActionLabel('Thêm ảnh')
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => MediaProcessor::itemLabel($state)),
                                ]),
                        ]),

                    SeoTab::make('faces_places_albums/seo'),
                ])
                ->columnSpanFull(),
        ]);
    }

    /**
     * @return array<string, string>
     */
    private static function statusOptions(): array
    {
        return [
            'draft' => 'Nháp',
            'published' => 'Đã xuất bản',
            'hidden' => 'Đang ẩn',
        ];
    }

    /**
     * @return array<string, string>
     */
    private static function statusColors(): array
    {
        return [
            'draft' => 'gray',
            'published' => 'success',
            'hidden' => 'danger',
        ];
    }

    /**
     * @return array<string, string>
     */
    private static function statusIcons(): array
    {
        return [
            'draft' => 'heroicon-o-pencil',
            'published' => 'heroicon-o-check-circle',
            'hidden' => 'heroicon-o-eye-slash',
        ];
    }


}
