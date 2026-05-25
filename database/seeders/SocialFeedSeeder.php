<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SocialFeed;
use Illuminate\Database\Seeder;

final class SocialFeedSeeder extends Seeder
{
    public function run(): void
    {
        for ($number = 1; $number <= 5; $number++) {
            SocialFeed::updateOrCreate(
                ['image_url' => "client/assets/static/home/follow-me-{$number}.png"],
                [
                    'platform' => 'instagram',
                    'post_url' => 'https://instagram.com/lahieuphotography',
                    'priority' => $number,
                    'status' => 'published',
                ]
            );
        }
    }
}
