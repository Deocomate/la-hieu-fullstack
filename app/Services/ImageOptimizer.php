<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Spatie\ImageOptimizer\OptimizerChain;
use Throwable;

final class ImageOptimizer
{
    public function __construct(
        private readonly OptimizerChain $optimizerChain,
    ) {}

    public function optimizePublicDiskPath(string $relativePath): bool
    {
        $relativePath = ltrim($relativePath, '/');

        if ($relativePath === '' || str_starts_with($relativePath, 'assets/')) {
            return false;
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($relativePath)) {
            return false;
        }

        $mimeType = (string) $disk->mimeType($relativePath);

        if (! str_starts_with($mimeType, 'image/') || $mimeType === 'image/svg+xml') {
            return false;
        }

        $absolutePath = $disk->path($relativePath);

        try {
            $this->optimizerChain->optimize($absolutePath);
            $this->generateWebp($absolutePath);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    public function generateWebp(string $absolutePath): ?string
    {
        if (! function_exists('imagewebp') || ! file_exists($absolutePath)) {
            return null;
        }

        $imageInfo = @getimagesize($absolutePath);

        if (! is_array($imageInfo)) {
            return null;
        }

        $source = match ($imageInfo[2]) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($absolutePath),
            IMAGETYPE_PNG => @imagecreatefrompng($absolutePath),
            IMAGETYPE_WEBP => @imagecreatefromwebp($absolutePath),
            default => null,
        };

        if ($source === false || $source === null) {
            return null;
        }

        $webpPath = preg_replace('/\.[^.]+$/', '.webp', $absolutePath) ?? ($absolutePath.'.webp');

        if (@imagewebp($source, $webpPath, 82) === false) {
            imagedestroy($source);

            return null;
        }

        imagedestroy($source);

        return $webpPath;
    }
}
