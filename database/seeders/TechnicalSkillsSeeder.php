<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class TechnicalSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('technical-skills') as $categoryName => $skillNames) {
            $category = SkillCategory::updateOrCreate(['name_en' => $categoryName], [
                'name_bn' => $categoryName,
                'sort_order' => array_search($categoryName, array_keys(config('technical-skills')), true) + 1,
            ]);

            foreach ($skillNames as $index => $skillName) {
                Skill::updateOrCreate(['skill_category_id' => $category->id, 'name' => $skillName], [
                    'sort_order' => $index + 1,
                ]);
            }
        }
    }
}
