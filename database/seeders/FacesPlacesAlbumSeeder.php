<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FacesPlacesAlbum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

final class FacesPlacesAlbumSeeder extends Seeder
{
    public function run(): void
    {
        $description = "Because a million or so die-hard Apple fanatics will buy anything Apple puts out, even if it is a brick on the contrary Apple is likely to respond with a calculated price cut for instance Apple's sales have peaked, until Android's already working on a rival to Siri's digital assistant";

        $albums = [
            ['title' => 'FLYCAM', 'images' => range(1, 9)],
            ['title' => 'NATURE & LANDSCAPE', 'images' => range(10, 18)],
            ['title' => 'FACES', 'images' => [19, 1, 3, 5, 7, 9, 11, 13, 15]],
            ['title' => 'ANIMALS', 'images' => [2, 4, 6, 8, 10, 12, 14, 16, 18]],
        ];

        foreach ($albums as $priority => $albumData) {
            $coverImage = "assets/static/faces-and-places/faces-and-places-{$albumData['images'][0]}.png";

            $album = FacesPlacesAlbum::updateOrCreate(
                ['slug' => Str::slug($albumData['title'])],
                [
                    'title' => $albumData['title'],
                    'description' => $description,
                    'cover_image' => $coverImage,
                    'hero_bg_text' => 'FACES & PLACES',
                    'priority' => $priority + 1,
                    'status' => 'published',
                    'seo_title' => "{$albumData['title']} - La Hieu Photography",
                    'seo_description' => Str::limit($description, 150),
                    'seo_image' => $coverImage,
                ]
            );

            $album->media()->delete();

            foreach ($albumData['images'] as $mediaPriority => $imageNumber) {
                $album->media()->create([
                    'collection_name' => 'gallery',
                    'file_name' => "faces-and-places-{$imageNumber}.png",
                    'file_url' => "assets/static/faces-and-places/faces-and-places-{$imageNumber}.png",
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
