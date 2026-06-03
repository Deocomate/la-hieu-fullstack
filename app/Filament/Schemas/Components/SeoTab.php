<?php

declare(strict_types=1);

namespace App\Filament\Schemas\Components;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;

final class SeoTab
{
    public static function make(string $directory = 'seo', ?string $description = null): Tab
    {
        $section = Section::make('Thông tin SEO');

        if ($description !== null) {
            $section->description($description);
        }

        return Tab::make('SEO')
            ->icon('heroicon-o-magnifying-glass')
            ->schema([
                $section->schema([
                    TextInput::make('seo_title')
                        ->label('SEO Title')
                        ->helperText('Tối đa 70 ký tự. Hiển thị trên tab trình duyệt và kết quả Google.')
                        ->maxLength(70),
                    Textarea::make('seo_description')
                        ->label('SEO Description')
                        ->helperText('Tối đa 160 ký tự. Đoạn mô tả xuất hiện dưới tiêu đề trong kết quả tìm kiếm.')
                        ->maxLength(160)
                        ->rows(3),
                    FileUpload::make('seo_image')
                        ->label('Ảnh SEO (Open Graph)')
                        ->helperText('Ảnh hiển thị khi chia sẻ link lên mạng xã hội. Khuyến nghị 1200x630px.')
                        ->disk('public')
                        ->directory($directory)
                        ->image()
                        ->imageEditor(),
                ])->columns(1),
            ]);
    }
}
