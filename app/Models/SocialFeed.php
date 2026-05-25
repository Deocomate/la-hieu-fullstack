<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class SocialFeed extends Model
{
    /** @use HasFactory<\Database\Factories\SocialFeedFactory> */
    use HasFactory;

    protected $fillable = [
        'platform',
        'image_url',
        'post_url',
        'priority',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'priority' => 'integer',
        ];
    }

    /**
     * @param  Builder<SocialFeed>  $query
     * @return Builder<SocialFeed>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    /**
     * @param  Builder<SocialFeed>  $query
     * @return Builder<SocialFeed>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('priority')->orderByDesc('created_at');
    }
}
