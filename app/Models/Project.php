<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['slug', 'title_en', 'title_bn', 'category', 'organization', 'role', 'summary_en', 'summary_bn', 'problem_en', 'problem_bn', 'solution_en', 'solution_bn', 'outcome_en', 'outcome_bn', 'development_year', 'status', 'cover_path', 'live_url', 'source_url', 'is_published', 'is_featured', 'sort_order'])]
class Project extends Model
{
    protected function casts(): array
    {
        return ['is_published' => 'boolean', 'is_featured' => 'boolean'];
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }
}
