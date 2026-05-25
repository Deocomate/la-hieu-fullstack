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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

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
                                                ->directory('faces_places_albums/gallery')
                                                ->image()
                                                ->imageEditor()
                                                ->required(),
                                        ])
                                        ->mutateRelationshipDataBeforeCreateUsing(fn (array $data): array => self::prepareMediaData($data))
                                        ->mutateRelationshipDataBeforeSaveUsing(fn (array $data): array => self::prepareMediaData($data))
                                        ->addActionLabel('Thêm ảnh')
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => self::mediaItemLabel($state)),
                                ]),
                        ]),

                    Tab::make('SEO')
                        ->icon('heroicon-o-magnifying-glass')
                        ->schema([
                            Section::make('Thông tin SEO')
                                ->schema([
                                    TextInput::make('seo_title')
                                        ->label('SEO Title')
                                        ->maxLength(70),
                                    Textarea::make('seo_description')
                                        ->label('SEO Description')
                                        ->maxLength(160)
                                        ->rows(3),
                                    FileUpload::make('seo_image')
                                        ->label('Ảnh SEO (Open Graph)')
                                        ->directory('faces_places_albums/seo')
                                        ->image()
                                        ->imageEditor(),
                                ])->columns(1),
                        ]),
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

    private static function mediaItemLabel(array $state): ?string
    {
        $fileUrl = self::fileUrlFromState($state['file_url'] ?? null);

        return $state['file_name'] ?? ($fileUrl ? basename($fileUrl) : null);
    }

    private static function prepareMediaData(array $data): array
    {
        $fileUrl = self::fileUrlFromState($data['file_url'] ?? null);

        $data['collection_name'] = 'gallery';
        $data['file_name'] = $fileUrl ? basename($fileUrl) : ($data['file_name'] ?? '');
        $data['custom_properties'] = $data['custom_properties'] ?? [];

        return array_merge($data, self::fileMetadata($fileUrl));
    }

    private static function fileUrlFromState(mixed $state): ?string
    {
        if (is_array($state)) {
            $state = reset($state);
        }

        return is_string($state) && $state !== '' ? $state : null;
    }

    /**
     * @return array{mime_type: ?string, size: ?int, width: ?int, height: ?int}
     */
    private static function fileMetadata(?string $path): array
    {
        $metadata = [
            'mime_type' => null,
            'size' => null,
            'width' => null,
            'height' => null,
        ];

        if (! $path) {
            return $metadata;
        }

        $disk = Storage::disk((string) config('filesystems.default'));

        try {
            if (! $disk->exists($path)) {
                return $metadata;
            }

            $metadata['mime_type'] = $disk->mimeType($path) ?: null;
            $metadata['size'] = $disk->size($path) ?: null;

            $absolutePath = $disk->path($path);
            $dimensions = @getimagesize($absolutePath);

            if (is_array($dimensions)) {
                $metadata['width'] = $dimensions[0] ?? null;
                $metadata['height'] = $dimensions[1] ?? null;
            }
        } catch (Throwable) {
            return $metadata;
        }

        return $metadata;
    }
}
