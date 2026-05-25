<?php

declare(strict_types=1);

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Thông tin đối tác')
                ->schema([
                    TextInput::make('name')
                        ->label('Tên đối tác')
                        ->required()
                        ->maxLength(255),
                    FileUpload::make('logo_image')
                        ->label('Logo đối tác')
                        ->directory('partners')
                        ->image()
                        ->required(),
                    TextInput::make('link_url')
                        ->label('Đường dẫn website')
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
