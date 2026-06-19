<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\ImageOptimizer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;

final class OptimizeExistingImages extends Command
{
    protected $signature = 'images:optimize-existing
                            {--dry-run : List files without optimizing}
                            {--disk=public : Filesystem disk to scan}';

    protected $description = 'Optimize existing uploaded images and generate WebP variants';

    public function handle(ImageOptimizer $imageOptimizer): int
    {
        $diskName = (string) $this->option('disk');
        $dryRun = (bool) $this->option('dry-run');
        $disk = Storage::disk($diskName);
        $root = $disk->path('');

        if (! is_dir($root)) {
            $this->error("Disk root not found: {$root}");

            return self::FAILURE;
        }

        $processed = 0;
        $skipped = 0;

        $finder = (new Finder)
            ->files()
            ->in($root)
            ->ignoreDotFiles(true)
            ->name(['*.jpg', '*.jpeg', '*.png', '*.webp']);

        foreach ($finder as $file) {
            $relativePath = str_replace('\\', '/', substr($file->getPathname(), strlen($root)));
            $relativePath = ltrim($relativePath, '/');

            if (str_starts_with($relativePath, 'assets/') || str_ends_with($relativePath, '.webp')) {
                $skipped++;

                continue;
            }

            if ($dryRun) {
                $this->line($relativePath);
                $processed++;

                continue;
            }

            if ($imageOptimizer->optimizePublicDiskPath($relativePath)) {
                $processed++;
                $this->line("Optimized: {$relativePath}");
            } else {
                $skipped++;
            }
        }

        $this->info("Processed: {$processed}; Skipped: {$skipped}");

        return self::SUCCESS;
    }
}
