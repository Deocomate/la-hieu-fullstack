<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SocialFeed;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SocialFeed>
 */
final class SocialFeedFactory extends Factory
{
    protected $model = SocialFeed::class;

    public function definition(): array
    {
        return [
            'platform' => 'instagram',
            'image_url' => 'assets/static/home/follow-me-1.png',
            'post_url' => '#',
            'priority' => 0,
            'status' => 'published',
        ];
    }
}
