<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
final class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        return [
            'model_type' => 'App\Models\EventAlbum',
            'model_id' => 1,
            'collection_name' => 'gallery',
            'file_name' => 'gallery-1.png',
            'file_url' => 'assets/static/event-photo/gallery-1.png',
            'mime_type' => 'image/png',
            'size' => 1024,
            'width' => 1920,
            'height' => 1080,
            'custom_properties' => [],
            'priority' => 0,
        ];
    }
}
