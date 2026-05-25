<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
final class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'type' => 'photojournalism',
            'category_id' => ArticleCategory::factory(),
            'title' => 'Default Article Title',
            'slug' => 'default-article-title',
            'excerpt' => 'Default excerpt content.',
            'cover_image' => 'client/assets/static/photojournalism/photo-image-card-1.png',
            'badge_logo' => 'client/assets/static/photojournalism/photo-logo-card-1.svg',
            'youtube_urls' => null,
            'content_blocks' => [],
            'published_at' => '2026-05-25 00:00:00',
            'is_featured' => false,
            'views_count' => 100,
            'priority' => 0,
            'status' => 'published',
            'seo_title' => 'Default Article Title',
            'seo_description' => 'Default Description',
            'seo_image' => 'client/assets/static/photojournalism/photo-image-card-1.png',
        ];
    }
}
