<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

final class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        for ($number = 1; $number <= 4; $number++) {
            Partner::updateOrCreate(
                ['name' => "Partner {$number}"],
                [
                    'logo_image' => "client/assets/static/home/partner-{$number}.png",
                    'link_url' => 'https://lahieu.com',
                    'priority' => $number,
                    'status' => 'published',
                ]
            );
        }
    }
}
