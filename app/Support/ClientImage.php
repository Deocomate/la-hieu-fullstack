<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class ClientImage
{
    public static function url(?string $path, ?string $fallback = null): string
    {
        $path = trim((string) ($path ?: $fallback));

        if ($path === '') {
            return '';
        }

        if (
            Str::startsWith($path, ['http://', 'https://', '//', '/'])
            || Str::startsWith($path, 'data:')
        ) {
            return $path;
        }

        if (Str::startsWith($path, 'client/assets/')) {
            if (Str::endsWith(strtolower($path), '.svg') || file_exists(public_path($path))) {
                return asset($path);
            }
            return Storage::disk('public')->url($path);
        }

        return Storage::disk('public')->url($path);
    }
}
