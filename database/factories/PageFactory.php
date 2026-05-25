<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Page>
 */
final class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'key' => 'default-page',
            'title' => 'Default Page',
            'hero_title' => 'Default Hero Title',
            'hero_subtitle' => 'Default Hero Subtitle',
            'hero_description' => 'Default Hero Description',
            'hero_bg_text' => 'DEFAULT BANNER',
            'hero_images' => ['client/assets/static/home/hero-image.png'],
            'content' => [],
            'seo_title' => 'Default Page',
            'seo_description' => 'Default Description',
            'seo_image' => 'client/assets/static/home/hero-image.png',
        ];
    }
}
