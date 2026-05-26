<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class EventAlbum extends Model
{
    /** @use HasFactory<\Database\Factories\EventAlbumFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'event_date',
        'hero_bg_text',
        'cover_image',
        'is_featured',
        'views_count',
        'priority',
        'status',
        'seo_title',
        'seo_description',
        'seo_image',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_featured' => 'boolean',
            'views_count' => 'integer',
            'priority' => 'integer',
        ];
    }

    /**
     * Get all of the album's media.
     *
     * @return MorphMany<Media, $this>
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    /**
     * @param  Builder<EventAlbum>  $query
     * @return Builder<EventAlbum>
     */
    public function scopePublished(Builder $query): Builder
    {
        $user = auth()->user();

        if ($user && in_array($user->role, ['admin', 'super_admin'], true)) {
            return $query;
        }

        return $query->where('status', 'published');
    }

    public function getPreviewUrl(): string
    {
        return route('event-photos.show', $this->slug);
    }

    /**
     * @param  Builder<EventAlbum>  $query
     * @return Builder<EventAlbum>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('priority')->orderByDesc('created_at');
    }
}
