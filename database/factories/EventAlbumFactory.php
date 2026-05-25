<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\EventAlbum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EventAlbum>
 */
final class EventAlbumFactory extends Factory
{
    protected $model = EventAlbum::class;

    public function definition(): array
    {
        return [
            'title' => 'Default Event Album',
            'slug' => 'default-event-album',
            'event_date' => '2026-05-25',
            'hero_bg_text' => 'EVENT PHOTOS',
            'cover_image' => 'client/assets/static/home/event-photography-1.png',
            'is_featured' => false,
            'views_count' => 100,
            'priority' => 0,
            'status' => 'published',
            'seo_title' => 'Default Event Album',
            'seo_description' => 'Default description',
            'seo_image' => 'client/assets/static/home/event-photography-1.png',
        ];
    }
}
