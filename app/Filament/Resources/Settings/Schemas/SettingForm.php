<?php

declare(strict_types=1);

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Thông tin cài đặt')
                ->schema([
                    Select::make('group')
                        ->label('Nhóm cài đặt')
                        ->options([
                            'general' => 'Cài đặt chung',
                            'contact' => 'Thông tin liên hệ',
                            'social' => 'Mạng xã hội',
                            'footer' => 'Chân trang (Footer)',
                        ])
                        ->required(),
                    TextInput::make('key')
                        ->label('Mã cài đặt')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->regex('/^[a-z_]+$/')
                        ->validationMessages([
                            'regex' => 'Mã cài đặt chỉ được chứa chữ thường và dấu gạch dưới (vd: site_name).',
                        ])
                        ->disabled(fn (string $context): bool => $context === 'edit'),
                    Textarea::make('value')
                        ->label('Giá trị')
                        ->rows(5)
                        ->nullable(),
                ])->columns(1),
        ]);
    }
}
