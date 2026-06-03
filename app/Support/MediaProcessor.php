<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Throwable;

final class MediaProcessor
{
    /**
     * Prepare relationship data before creating or saving media.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function prepare(array $data, string $collectionName = 'gallery'): array
    {
        $fileUrl = self::fileUrlFromState($data['file_url'] ?? null);

        $data['collection_name'] = $collectionName;
        $data['file_name'] = $fileUrl ? basename($fileUrl) : ($data['file_name'] ?? '');
        $data['custom_properties'] = $data['custom_properties'] ?? [];

        return array_merge($data, self::fileMetadata($fileUrl));
    }

    /**
     * Get label for media item.
     *
     * @param  array<string, mixed>  $state
     */
    public static function itemLabel(array $state): ?string
    {
        $fileUrl = self::fileUrlFromState($state['file_url'] ?? null);

        return $state['file_name'] ?? ($fileUrl ? basename($fileUrl) : null);
    }

    /**
     * Extract file URL string from upload state.
     */
    public static function fileUrlFromState(mixed $state): ?string
    {
        if (is_array($state)) {
            $state = reset($state);
        }

        return is_string($state) && $state !== '' ? $state : null;
    }

    /**
     * Get mime type, size, and image dimensions safely.
     *
     * @return array{mime_type: ?string, size: ?int, width: ?int, height: ?int}
     */
    public static function fileMetadata(?string $path): array
    {
        $metadata = [
            'mime_type' => null,
            'size' => null,
            'width' => null,
            'height' => null,
        ];

        if (! $path) {
            return $metadata;
        }

        $diskName = (string) config('filesystems.default');
        $disk = Storage::disk($diskName);

        try {
            if (! $disk->exists($path)) {
                return $metadata;
            }

            $metadata['mime_type'] = $disk->mimeType($path) ?: null;
            $metadata['size'] = $disk->size($path) ?: null;

            // Only run getimagesize if driver is local/public to prevent remote download issues
            $driver = config("filesystems.disks.{$diskName}.driver", 'local');
            if (in_array($driver, ['local', 'public'])) {
                $absolutePath = $disk->path($path);
                if (file_exists($absolutePath)) {
                    $dimensions = @getimagesize($absolutePath);

                    if (is_array($dimensions)) {
                        $metadata['width'] = $dimensions[0] ?? null;
                        $metadata['height'] = $dimensions[1] ?? null;
                    }
                }
            }
        } catch (Throwable) {
            return $metadata;
        }

        return $metadata;
    }
}
