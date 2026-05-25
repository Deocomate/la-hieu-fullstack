<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Page extends Model
{
    /** @use HasFactory<\Database\Factories\PageFactory> */
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'hero_bg_text',
        'hero_images',
        'content',
        'seo_title',
        'seo_description',
        'seo_image',
    ];

    protected function casts(): array
    {
        return [
            'hero_images' => 'array',
            'content' => 'array',
        ];
    }
}
