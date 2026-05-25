<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

final class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '090 2222 876'],
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'pvduchieu@gmail.com'],
            ['group' => 'social', 'key' => 'social_instagram', 'value' => 'lahieuphotography'],
            ['group' => 'footer', 'key' => 'footer_author_name', 'value' => 'Nguyễn Đức Hiếu'],
            ['group' => 'footer', 'key' => 'footer_quote', 'value' => "I'm always ready for the next journey\nLet’s talk about yours"],
            ['group' => 'seo', 'key' => 'seo_site_name', 'value' => 'La Hieu Photography'],
            ['group' => 'seo', 'key' => 'seo_default_title', 'value' => 'La Hieu Photography'],
            ['group' => 'seo', 'key' => 'seo_default_description', 'value' => 'Professional photography, photojournalism, videography, events, faces and places by La Hieu.'],
            ['group' => 'seo', 'key' => 'seo_default_image', 'value' => 'client/assets/static/home/hero-image.png'],
            ['group' => 'seo', 'key' => 'seo_meta_tags', 'value' => '[]'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
