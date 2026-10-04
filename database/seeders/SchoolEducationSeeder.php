<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class SchoolEducationSeeder extends Seeder
{
    public function run(): void
    {
        Education::updateOrCreate(['degree_en' => 'HSC'], [
            'degree_bn' => 'HSC',
            'institution_en' => 'Rajshahi Collegiate School & College',
            'institution_bn' => 'Rajshahi Collegiate School & College',
            'graduated_year' => 2014,
            'sort_order' => 3,
        ]);

        Education::updateOrCreate(['degree_en' => 'SSC'], [
            'degree_bn' => 'SSC',
            'institution_en' => 'Rajshahi Govt Laboratory High School',
            'institution_bn' => 'Rajshahi Govt Laboratory High School',
            'graduated_year' => 2012,
            'sort_order' => 4,
        ]);
    }
}
