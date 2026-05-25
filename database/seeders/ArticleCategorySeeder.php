<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

final class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Photojournalism', 'slug' => 'photojournalism'],
            ['name' => 'Videography', 'slug' => 'videography'],
        ];

        foreach ($categories as $category) {
            ArticleCategory::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
