<?php

declare(strict_types=1);

namespace App\Support;

final class Seo
{
    /**
     * @param  array<string, mixed>|null  $settings
     * @return array{title: string, description: string, image: string|null}
     */
    public static function fromModel(?object $model, ?array $settings = null): array
    {
        $settings ??= [];

        $title = $model?->seo_title ?? $model?->title ?? config('app.name');
        $description = $model?->seo_description ?? '';
        $image = $model?->seo_image ?? ($settings['seo_default_image'] ?? null);

        return [
            'title' => is_string($title) ? $title : (string) config('app.name'),
            'description' => is_string($description) ? $description : '',
            'image' => is_string($image) ? $image : null,
        ];
    }
}
