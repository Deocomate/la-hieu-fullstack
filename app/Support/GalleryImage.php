<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\Media;
use Illuminate\Support\Collection;

final class GalleryImage
{
    /**
     * @return list<array{src: string, thumb: string, alt: string, width: int, height: int}>
     */
    public static function fromMediaCollection(Collection $media, string $altPrefix = 'Gallery Image'): array
    {
        return $media
            ->sortBy('priority')
            ->values()
            ->map(fn (Media $item, int $index): array => self::fromMedia($item, "{$altPrefix} ".($index + 1)))
            ->all();
    }

    /**
     * @return array{src: string, thumb: string, alt: string, width: int, height: int}
     */
    public static function fromMedia(Media $media, string $alt): array
    {
        $src = ClientImage::url($media->file_url);

        return [
            'src' => $src,
            'thumb' => $src,
            'alt' => $alt,
            'width' => (int) ($media->width ?: 0),
            'height' => (int) ($media->height ?: 0),
        ];
    }

    /**
     * @param  iterable<string>  $paths
     * @return list<array{src: string, thumb: string, alt: string, width: int, height: int}>
     */
    public static function fromPaths(iterable $paths, string $altPrefix = 'Gallery Image'): array
    {
        $images = [];

        foreach (collect($paths)->filter()->values() as $index => $path) {
            $src = is_string($path) ? $path : ClientImage::url((string) $path);

            if ($src === '') {
                continue;
            }

            $images[] = [
                'src' => $src,
                'thumb' => $src,
                'alt' => "{$altPrefix} ".($index + 1),
                'width' => 0,
                'height' => 0,
            ];
        }

        return $images;
    }
}
