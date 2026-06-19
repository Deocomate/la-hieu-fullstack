<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\EventAlbum;
use App\Models\FacesPlacesAlbum;
use App\Models\Media;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\SocialFeed;
use Illuminate\Console\Command;

final class MigrateAssetPaths extends Command
{
    protected $signature = 'assets:migrate-paths {--dry-run : Preview changes without saving}';

    protected $description = 'Migrate client/assets/ paths to assets/ in database records';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $updated = 0;

        $stringColumns = [
            [Page::class, ['seo_image']],
            [Article::class, ['cover_image', 'badge_logo', 'seo_image']],
            [EventAlbum::class, ['cover_image', 'seo_image']],
            [FacesPlacesAlbum::class, ['cover_image', 'seo_image']],
            [Partner::class, ['logo_image']],
            [SocialFeed::class, ['image_url']],
            [Media::class, ['file_url']],
            [Setting::class, ['value']],
        ];

        foreach ($stringColumns as [$modelClass, $columns]) {
            $modelClass::query()->each(function ($model) use ($columns, $dryRun, &$updated): void {
                $changes = [];

                foreach ($columns as $column) {
                    $value = $model->{$column};

                    if (is_string($value) && str_contains($value, 'client/assets/')) {
                        $changes[$column] = str_replace('client/assets/', 'assets/', $value);
                    }
                }

                if ($changes === []) {
                    return;
                }

                $this->line(sprintf('%s #%s: %s', class_basename($model), $model->getKey(), json_encode($changes)));
                $updated++;

                if (! $dryRun) {
                    $model->update($changes);
                }
            });
        }

        Page::query()->each(function (Page $page) use ($dryRun, &$updated): void {
            $heroImages = $page->hero_images;

            if (! is_array($heroImages)) {
                return;
            }

            $migrated = array_map(
                fn ($path) => is_string($path) ? str_replace('client/assets/', 'assets/', $path) : $path,
                $heroImages
            );

            if ($migrated === $heroImages) {
                return;
            }

            $this->line(sprintf('Page #%s hero_images migrated', $page->getKey()));
            $updated++;

            if (! $dryRun) {
                $page->update(['hero_images' => $migrated]);
            }
        });

        $this->info($dryRun ? "Would update {$updated} record(s)." : "Updated {$updated} record(s).");

        return self::SUCCESS;
    }
}
