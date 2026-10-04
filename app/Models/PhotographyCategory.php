<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['slug', 'name_en', 'name_bn', 'sort_order'])]
class PhotographyCategory extends Model
{
    public function photographs(): HasMany
    {
        return $this->hasMany(Photograph::class);
    }
}
