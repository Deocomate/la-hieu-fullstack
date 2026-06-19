<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Partner>
 */
final class PartnerFactory extends Factory
{
    protected $model = Partner::class;

    public function definition(): array
    {
        return [
            'name' => 'Default Partner',
            'logo_image' => 'assets/static/home/partner-1.png',
            'link_url' => '#',
            'priority' => 0,
            'status' => 'published',
        ];
    }
}
