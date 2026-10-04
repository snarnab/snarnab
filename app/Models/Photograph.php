<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['photography_category_id', 'title_en', 'title_bn', 'image_path', 'location', 'photographed_year', 'story_en', 'story_bn', 'camera', 'lens', 'is_featured', 'is_published', 'sort_order'])]
class Photograph extends Model
{
    protected function casts(): array
    {
        return ['is_featured' => 'boolean', 'is_published' => 'boolean'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PhotographyCategory::class, 'photography_category_id');
    }
}
