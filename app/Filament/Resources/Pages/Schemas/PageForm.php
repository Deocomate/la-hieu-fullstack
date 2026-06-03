<?php

declare(strict_types=1);

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use App\Filament\Schemas\Components\SeoTab;
use Filament\Schemas\Schema;

final class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Tabs')
                ->tabs([
                    SeoTab::make('pages/seo', 'Tối ưu hóa công cụ tìm kiếm cho trang này.'),

                    Tab::make('Hero / Header')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            Section::make('Thông tin chung')
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Tên trang (nội bộ)')
                                        ->helperText('Chỉ dùng để nhận diện trong admin, không hiển thị trên website.')
                                        ->disabled(),
                                    TextInput::make('key')
                                        ->label('Mã trang')
                                        ->helperText('Mã định danh cố định, không thể thay đổi.')
                                        ->disabled(),
                                ])->columns(2),

                            Section::make('Nội dung Hero')
                                ->schema([
                                    TextInput::make('hero_title')
                                        ->label('Tiêu đề Hero')
                                        ->helperText('Dòng chữ lớn nhất xuất hiện nổi bật nhất trên trang. Dùng \\n để xuống dòng.')
                                        ->maxLength(255),
                                    TextInput::make('hero_subtitle')
                                        ->label('Phụ đề Hero')
                                        ->helperText('Dòng chữ nhỏ bên dưới tiêu đề chính.')
                                        ->maxLength(255)
                                        ->visible(fn (Get $get): bool => in_array($get('key'), [
                                            'about', 'event-photos', 'photojournalism',
                                        ])),
                                    Textarea::make('hero_description')
                                        ->label('Mô tả Hero')
                                        ->helperText('Đoạn văn mô tả ngắn xuất hiện bên dưới tiêu đề.')
                                        ->rows(4)
                                        ->visible(fn (Get $get): bool => in_array($get('key'), [
                                            'home', 'about', 'contact', 'event-photos',
                                        ])),
                                    TextInput::make('hero_bg_text')
                                        ->label('Chữ nền phía sau (Background Text)')
                                        ->helperText('Chữ in hoa mờ hiển thị phía sau hero banner. Ví dụ: EVENT PHOTOS, VIDEOGRAPHY.')
                                        ->maxLength(100)
                                        ->visible(fn (Get $get): bool => in_array($get('key'), [
                                            'event-photos', 'faces-and-places', 'photojournalism', 'videography',
                                        ])),
                                ])->columns(1),

                            Section::make('Hình ảnh Hero')
                                ->schema([
                                    FileUpload::make('hero_images.hero_banner')
                                        ->label('Ảnh Banner chính')
                                        ->disk('public')
                                        ->helperText('Ảnh lớn hiển thị phía trên trang chủ (ảnh cô gái H\'Mông). Để trống = dùng ảnh mặc định.')
                                        ->directory('pages/home')
                                        ->image()
                                        ->imageEditor()
                                        ->visible(fn (Get $get): bool => $get('key') === 'home'),
                                    FileUpload::make('hero_images.signature_logo')
                                        ->label('Ảnh chữ ký (Signature)')
                                        ->disk('public')
                                        ->helperText('Logo chữ ký La Hiếu bên dưới nội dung. Để trống = dùng ảnh mặc định.')
                                        ->directory('pages/signatures')
                                        ->image()
                                        ->visible(fn (Get $get): bool => in_array($get('key'), ['home', 'about'])),
                                    FileUpload::make('hero_images.about_image')
                                        ->label('Ảnh chân dung')
                                        ->disk('public')
                                        ->helperText('Ảnh chân dung La Hiếu hiển thị bên trái trang About. Để trống = dùng ảnh mặc định.')
                                        ->directory('pages/about')
                                        ->image()
                                        ->imageEditor()
                                        ->visible(fn (Get $get): bool => $get('key') === 'about'),
                                    FileUpload::make('hero_images.contact_image')
                                        ->label('Ảnh chuyến đi (Contact)')
                                        ->disk('public')
                                        ->helperText('Ảnh phong cảnh hiển thị bên trái trang Contact. Để trống = dùng ảnh mặc định.')
                                        ->directory('pages/contact')
                                        ->image()
                                        ->imageEditor()
                                        ->visible(fn (Get $get): bool => $get('key') === 'contact'),
                                ])->columns(2)
                                ->visible(fn (Get $get): bool => in_array($get('key'), ['home', 'about', 'contact'])),
                        ]),

                    Tab::make('Nội dung trang chủ')
                        ->icon('heroicon-o-home')
                        ->visible(fn (Get $get): bool => $get('key') === 'home')
                        ->schema([
                            Section::make('Section: Event Photography')
                                ->description('Quản lý nội dung block "Event photography" trên trang chủ.')
                                ->schema([
                                    TextInput::make('content.event.title')
                                        ->label('Tiêu đề section')
                                        ->helperText('Ví dụ: Event photography')
                                        ->maxLength(100),
                                    Textarea::make('content.event.description')
                                        ->label('Mô tả section')
                                        ->rows(3),
                                    FileUpload::make('content.event.bg_image')
                                        ->label('Ảnh nền (Background)')
                                        ->disk('public')
                                        ->helperText('Ảnh nền tối phía sau section Event. Để trống = dùng ảnh mặc định.')
                                        ->directory('pages/home/event')
                                        ->image()
                                        ->imageEditor(),
                                ])->columns(1),

                            Section::make('Section: Faces & Places')
                                ->description('Quản lý nội dung block "Faces & Places" trên trang chủ.')
                                ->schema([
                                    TextInput::make('content.faces.title')
                                        ->label('Tiêu đề section')
                                        ->helperText('Ví dụ: faces & places')
                                        ->maxLength(100),
                                    Textarea::make('content.faces.description')
                                        ->label('Mô tả section')
                                        ->rows(3),
                                ])->columns(1),

                            Section::make('Section: Photojournalism')
                                ->description('Quản lý nội dung block "Photojournalism" trên trang chủ.')
                                ->schema([
                                    TextInput::make('content.photojournalism.title')
                                        ->label('Tiêu đề section')
                                        ->helperText('Ví dụ: photojournalism')
                                        ->maxLength(100),
                                    Textarea::make('content.photojournalism.description')
                                        ->label('Mô tả section')
                                        ->rows(4),
                                    FileUpload::make('content.photojournalism.desktop_bg')
                                        ->label('Ảnh nền Desktop')
                                        ->disk('public')
                                        ->helperText('Ảnh nền hiển thị trên màn hình Desktop. Để trống = dùng ảnh mặc định.')
                                        ->directory('pages/home/photojournalism')
                                        ->image()
                                        ->imageEditor(),
                                    Repeater::make('content.photojournalism.mobile_bg_slides')
                                        ->label('Slideshow ảnh nền Mobile')
                                        ->helperText('Các ảnh chạy slideshow trên nền section Photojournalism (chỉ mobile). Để trống = dùng ảnh mặc định.')
                                        ->schema([
                                            FileUpload::make('image')
                                                ->label('Ảnh slide')
                                                ->disk('public')
                                                ->directory('pages/home/photojournalism/slides')
                                                ->image()
                                                ->imageEditor()
                                                ->required(),
                                        ])
                                        ->addActionLabel('Thêm ảnh slide')
                                        ->reorderable()
                                        ->collapsible(),
                                ])->columns(1),

                            Section::make('Section: Videography')
                                ->description('Quản lý nội dung block "Videography" trên trang chủ.')
                                ->schema([
                                    TextInput::make('content.videography.title')
                                        ->label('Tiêu đề section')
                                        ->helperText('Ví dụ: Videography')
                                        ->maxLength(100),
                                    Textarea::make('content.videography.description')
                                        ->label('Mô tả section')
                                        ->rows(3),
                                ])->columns(1),

                            Section::make('Section: Partners')
                                ->description('Quản lý tiêu đề block "Partners" trên trang chủ.')
                                ->schema([
                                    Textarea::make('content.partners.title')
                                        ->label('Tiêu đề section')
                                        ->helperText('Dùng \\n để xuống dòng. Ví dụ: "I don\'t walk this road alone\\nMeet the partners..."')
                                        ->rows(3),
                                ])->columns(1),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }
}
