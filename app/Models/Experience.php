<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title_en', 'title_bn', 'organization_en', 'organization_bn', 'location', 'employment_type', 'started_at', 'ended_at', 'is_current', 'details_en', 'details_bn', 'sort_order'])]
class Experience extends Model
{
    protected function casts(): array
    {
        return ['started_at' => 'date', 'ended_at' => 'date', 'is_current' => 'boolean'];
    }
}
