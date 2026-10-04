<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'title_bn', 'title_en', 'creative_title_bn', 'creative_title_en', 'intro_bn', 'intro_en', 'about_bn', 'about_en', 'location', 'image_path'])]
class Profile extends Model
{
}
