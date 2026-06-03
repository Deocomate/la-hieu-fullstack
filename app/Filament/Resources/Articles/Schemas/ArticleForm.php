<?php

declare(strict_types=1);

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use App\Filament\Schemas\Components\SeoTab;
use App\Support\MediaProcessor;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Str;

final class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('ArticleTabs')
                ->tabs([
                    Tab::make('Thông tin chung')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Section::make('Thông tin bài viết')
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Tiêu đề')
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
                                    Select::make('type')
                                        ->label('Loại bài')
                                        ->options(self::typeOptions())
                                        ->default('photojournalism')
                                        ->live()
                                        ->afterStateUpdated(function (?string $state, Set $set): void {
                                            if ($state !== 'videography') {
                                                $set('youtube_urls', []);
                                            }
                                        })
                                        ->required(),
                                    Select::make('category_id')
                                        ->label('Danh mục')
                                        ->relationship('category', 'name')
                                        ->searchable()
                                        ->preload(),
                                    Textarea::make('excerpt')
                                        ->label('Tóm tắt')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                    Toggle::make('is_featured')
                                        ->label('Bài viết nổi bật')
                                        ->default(false),
                                    ToggleButtons::make('status')
                                        ->label('Trạng thái')
                                        ->options(self::statusOptions())
                                        ->colors(self::statusColors())
                                        ->icons(self::statusIcons())
                                        ->default('published')
                                        ->inline()
                                        ->required(),
                                    TextInput::make('priority')
                                        ->label('Thứ tự hiển thị')
                                        ->numeric()
                                        ->default(0)
                                        ->required(),
                                    DateTimePicker::make('published_at')
                                        ->label('Ngày xuất bản')
                                        ->seconds(false),
                                    TextInput::make('views_count')
                                        ->label('Lượt xem')
                                        ->numeric()
                                        ->disabled()
                                        ->dehydrated(false),
                                ])->columns(2),
                        ]),

                    Tab::make('Hình ảnh & Video')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Section::make('Ảnh đại diện')
                                ->schema([
                                    FileUpload::make('cover_image')
                                        ->label('Ảnh đại diện')
                                        ->disk('public')
                                        ->directory('articles/covers')
                                        ->image()
                                        ->imageEditor(),
                                    FileUpload::make('badge_logo')
                                        ->label('Badge logo')
                                        ->disk('public')
                                        ->directory('articles/badges')
                                        ->acceptedFileTypes([
                                            'image/svg+xml',
                                            'image/png',
                                            'image/jpeg',
                                            'image/webp',
                                        ]),
                                ])->columns(2),

                            Section::make('Video YouTube')
                                ->schema([
                                    Repeater::make('youtube_urls')
                                        ->label('Danh sách video')
                                        ->simple(
                                            TextInput::make('url')
                                                ->label('YouTube URL hoặc ID')
                                                ->required()
                                                ->maxLength(255),
                                        )
                                        ->default([])
                                        ->addActionLabel('Thêm video')
                                        ->reorderable()
                                        ->dehydrated(fn (Get $get): bool => $get('type') === 'videography')
                                        ->visible(fn (Get $get): bool => $get('type') === 'videography'),
                                ])
                                ->visible(fn (Get $get): bool => $get('type') === 'videography'),

                            Section::make('Thư viện Slider')
                                ->schema([
                                    Repeater::make('media')
                                        ->label('Danh sách ảnh')
                                        ->relationship(
                                            modifyQueryUsing: fn (EloquentBuilder $query): EloquentBuilder => $query
                                                ->where('collection_name', 'slider')
                                                ->orderBy('priority'),
                                        )
                                        ->orderColumn('priority')
                                        ->schema([
                                            FileUpload::make('file_url')
                                                ->label('Ảnh')
                                                ->disk('public')
                                                ->directory('articles/slider')
                                                ->image()
                                                ->imageEditor()
                                                ->required(),
                                        ])
                                        ->mutateRelationshipDataBeforeCreateUsing(fn (array $data): array => MediaProcessor::prepare($data, 'slider'))
                                        ->mutateRelationshipDataBeforeSaveUsing(fn (array $data): array => MediaProcessor::prepare($data, 'slider'))
                                        ->addActionLabel('Thêm ảnh')
                                        ->collapsible()
                                        ->itemLabel(fn (array $state): ?string => MediaProcessor::itemLabel($state)),
                                ]),
                        ]),

                    Tab::make('Nội dung chi tiết')
                        ->icon('heroicon-o-bars-3-bottom-left')
                        ->schema([
                            Section::make('Builder nội dung')
                                ->schema([
                                    Builder::make('content_blocks')
                                        ->label('Khối nội dung')
                                        ->blocks(self::contentBlocks())
                                        ->afterStateHydrated(function (Builder $component, ?array $state): void {
                                            $component->state(self::hydrateContentBlocks($state));
                                            $component->hydrateItems();
                                        })
                                        ->mutateDehydratedStateUsing(fn (?array $state): array => self::dehydrateContentBlocks($state))
                                        ->addActionLabel('Thêm khối nội dung')
                                        ->blockPickerColumns(2)
                                        ->collapsible()
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    SeoTab::make('articles/seo'),
                ])
                ->columnSpanFull(),
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function normalizeFormData(array $data): array
    {
        if (($data['type'] ?? null) !== 'videography') {
            $data['youtube_urls'] = [];
        }

        return $data;
    }

    /**
     * @return array<string, string>
     */
    private static function typeOptions(): array
    {
        return [
            'photojournalism' => 'Photojournalism',
            'videography' => 'Videography',
        ];
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

    /**
     * @return array<Block>
     */
    private static function contentBlocks(): array
    {
        return [
            Block::make('dropcap_paragraph')
                ->label('Đoạn mở đầu Dropcap')
                ->schema([
                    TextInput::make('dropcap')
                        ->label('Chữ cái đầu')
                        ->maxLength(1)
                        ->required(),
                    Textarea::make('text')
                        ->label('Nội dung')
                        ->rows(5)
                        ->required(),
                ])
                ->columns(1),
            Block::make('heading')
                ->label('Tiêu đề')
                ->schema([
                    TextInput::make('text')
                        ->label('Tiêu đề')
                        ->required()
                        ->maxLength(255),
                ]),
            Block::make('paragraph')
                ->label('Đoạn văn')
                ->schema([
                    Textarea::make('text')
                        ->label('Nội dung')
                        ->rows(5)
                        ->required(),
                ]),
            Block::make('link')
                ->label('Liên kết')
                ->schema([
                    Textarea::make('text')
                        ->label('Nội dung')
                        ->rows(3),
                    TextInput::make('link_text')
                        ->label('Nhãn link')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('url')
                        ->label('URL')
                        ->required()
                        ->maxLength(255),
                ])
                ->columns(1),
        ];
    }

    /**
     * @param  array<int|string, array<string, mixed>>|null  $blocks
     * @return array<int, array{type: string, data: array<string, mixed>}>
     */
    private static function hydrateContentBlocks(?array $blocks): array
    {
        $items = [];

        foreach ($blocks ?? [] as $block) {
            if (! is_array($block) || blank($block['type'] ?? null)) {
                continue;
            }

            if (isset($block['data']) && is_array($block['data'])) {
                $items[] = [
                    'type' => (string) $block['type'],
                    'data' => $block['data'],
                ];

                continue;
            }

            $data = $block;
            unset($data['type']);

            $items[] = [
                'type' => (string) $block['type'],
                'data' => $data,
            ];
        }

        return $items;
    }

    /**
     * @param  array<int|string, array<string, mixed>>|null  $blocks
     * @return array<int, array<string, mixed>>
     */
    private static function dehydrateContentBlocks(?array $blocks): array
    {
        $items = [];

        foreach ($blocks ?? [] as $block) {
            if (! is_array($block) || blank($block['type'] ?? null)) {
                continue;
            }

            $data = isset($block['data']) && is_array($block['data'])
                ? $block['data']
                : $block;

            unset($data['type']);

            $items[] = array_merge([
                'type' => (string) $block['type'],
            ], $data);
        }

        return $items;
    }


}
