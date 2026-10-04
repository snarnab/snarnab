<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title_en', 'title_bn', 'description_en', 'description_bn', 'youtube_url', 'facebook_url', 'image_path', 'is_featured', 'is_published', 'sort_order'])]
class MusicItem extends Model
{
    protected function casts(): array
    {
        return ['is_featured' => 'boolean', 'is_published' => 'boolean'];
    }
}
