<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Media;
use App\Services\ImageOptimizer;

final class MediaObserver
{
    public function __construct(
        private readonly ImageOptimizer $imageOptimizer,
    ) {}

    public function saved(Media $media): void
    {
        if (! is_string($media->file_url) || $media->file_url === '') {
            return;
        }

        $this->imageOptimizer->optimizePublicDiskPath($media->file_url);
    }
}
