<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['platform', 'profile_url', 'service_en', 'service_bn', 'details_en', 'details_bn', 'is_published', 'sort_order'])]
class FreelanceProfile extends Model
{
    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }
}
