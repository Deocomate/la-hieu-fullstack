<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\EventAlbum;
use Illuminate\Database\Seeder;

final class EventAlbumSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'P4G Vietnam Summit',
                'slug' => 'p4g-vietnam-summit',
                'event_date' => '2019-06-16',
                'cover_image' => 'client/assets/static/home/event-photography-1.png',
                'images' => range(1, 8),
            ],
            [
                'title' => 'Goethe: The Gem',
                'slug' => 'goeth-the-gem',
                'event_date' => '2020-08-08',
                'cover_image' => 'client/assets/static/home/event-photography-2.png',
                'images' => range(9, 15),
            ],
            [
                'title' => 'La Hieu Project',
                'slug' => 'la-hieu-project',
                'event_date' => '2021-01-01',
                'cover_image' => 'client/assets/static/home/event-photography-3.png',
                'images' => [16, 17, 18, 19, 1, 3, 6],
            ],
        ];

        foreach ($events as $priority => $event) {
            $album = EventAlbum::updateOrCreate(
                ['slug' => $event['slug']],
                [
                    'title' => $event['title'],
                    'event_date' => $event['event_date'],
                    'hero_bg_text' => 'EVENT PHOTOS',
                    'cover_image' => $event['cover_image'],
                    'is_featured' => true,
                    'views_count' => 100 * ($priority + 1),
                    'priority' => $priority + 1,
                    'status' => 'published',
                    'seo_title' => "{$event['title']} - La Hieu Photography",
                    'seo_description' => "Event photos of {$event['title']} by La Hieu Photography.",
                    'seo_image' => $event['cover_image'],
                ]
            );

            $album->media()->delete();

            foreach ($event['images'] as $mediaPriority => $imageNumber) {
                $album->media()->create([
                    'collection_name' => 'gallery',
                    'file_name' => "gallery-{$imageNumber}.png",
                    'file_url' => "client/assets/static/event-photo/gallery-{$imageNumber}.png",
                    'mime_type' => 'image/png',
                    'size' => 1024,
                    'width' => 1920,
                    'height' => 1080,
                    'custom_properties' => [],
                    'priority' => $mediaPriority,
                ]);
            }
        }
    }
}
