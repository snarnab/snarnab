<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['degree_en', 'degree_bn', 'institution_en', 'institution_bn', 'field_of_study', 'started_year', 'graduated_year', 'details_en', 'details_bn', 'sort_order'])]
class Education extends Model
{
    protected $table = 'educations';
}
