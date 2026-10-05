<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class RuetProjectPreviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::query()->where('slug', 'ruet-cse-inventory-system')->update([
            'title_en' => 'Inventory System - RUET CSE',
            'organization' => 'RUET CSE Inventory System',
            'cover_path' => 'projects/ruet-inventory-preview.png',
        ]);
    }
}
