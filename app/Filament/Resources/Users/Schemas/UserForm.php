<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

final class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Thông tin tài khoản')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    TextInput::make('password')
                        ->password()
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context): bool => $context === 'create')
                        ->maxLength(255),
                    Select::make('role')
                        ->options([
                            'admin' => 'Admin',
                            'super_admin' => 'Super Admin',
                        ])
                        ->required()
                        // Chỉ Super Admin mới được chọn vai trò, và không được tự đổi vai trò của chính mình
                        ->disabled(fn (?User $record) => 
                            !auth()->user()?->isSuperAdmin() || 
                            ($record && $record->id === auth()->id())
                        ),
                ])->columns(2),
        ]);
    }
}
