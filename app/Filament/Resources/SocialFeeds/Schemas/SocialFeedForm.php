<?php

declare(strict_types=1);

namespace App\Filament\Resources\SocialFeeds\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class SocialFeedForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Thông tin bài viết mạng xã hội')
                ->schema([
                    Select::make('platform')
                        ->label('Nền tảng')
                        ->options([
                            'instagram' => 'Instagram',
                            'facebook' => 'Facebook',
                            'tiktok' => 'TikTok',
                        ])
                        ->default('instagram')
                        ->required(),
                    FileUpload::make('image_url')
                        ->label('Ảnh feed')
                        ->disk('public')
                        ->directory('social_feeds')
                        ->image()
                        ->required(),
                    TextInput::make('post_url')
                        ->label('Đường dẫn bài viết')
                        ->url()
                        ->maxLength(255)
                        ->nullable(),
                    TextInput::make('priority')
                        ->label('Thứ tự hiển thị')
                        ->numeric()
                        ->default(0)
                        ->required(),
                    ToggleButtons::make('status')
                        ->label('Trạng thái')
                        ->options([
                            'draft' => 'Nháp',
                            'published' => 'Đã xuất bản',
                            'hidden' => 'Đang ẩn',
                        ])
                        ->colors([
                            'draft' => 'gray',
                            'published' => 'success',
                            'hidden' => 'danger',
                        ])
                        ->icons([
                            'draft' => 'heroicon-o-pencil',
                            'published' => 'heroicon-o-check-circle',
                            'hidden' => 'heroicon-o-eye-slash',
                        ])
                        ->default('published')
                        ->inline()
                        ->required(),
                ])->columns(1),
        ]);
    }
}
