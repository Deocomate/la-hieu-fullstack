<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class Media extends Model
{
    /** @use HasFactory<\Database\Factories\MediaFactory> */
    use HasFactory;

    protected $fillable = [
        'model_type',
        'model_id',
        'collection_name',
        'file_name',
        'file_url',
        'mime_type',
        'size',
        'width',
        'height',
        'custom_properties',
        'priority',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'width' => 'integer',
            'height' => 'integer',
            'custom_properties' => 'array',
            'priority' => 'integer',
        ];
    }

    /**
     * Get the parent model that owns the media.
     *
     * @return MorphTo<Model, $this>
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
