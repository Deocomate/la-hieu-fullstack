<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FacesPlacesAlbum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FacesPlacesAlbum>
 */
final class FacesPlacesAlbumFactory extends Factory
{
    protected $model = FacesPlacesAlbum::class;

    public function definition(): array
    {
        return [
            'title' => 'Default Faces & Places Album',
            'slug' => 'default-faces-places-album',
            'description' => 'Default description about faces & places',
            'cover_image' => 'client/assets/static/faces-and-places/faces-and-places-1.png',
            'hero_bg_text' => 'FACES & PLACES',
            'priority' => 0,
            'status' => 'published',
            'seo_title' => 'Default Faces & Places Album',
            'seo_description' => 'Default description',
            'seo_image' => 'client/assets/static/faces-and-places/faces-and-places-1.png',
        ];
    }
}
