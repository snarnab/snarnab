<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ConsultancyProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::updateOrCreate(['slug' => 'ruet-cse-consultancy'], [
            'title_en' => 'Consultancy Software - RUET CSE',
            'title_bn' => 'RUET CSE — কনসালটেন্সি সফটওয়্যার',
            'category' => 'software',
            'organization' => 'RUET CSE Consultancy',
            'role' => 'Developer',
            'summary_en' => 'A web-based consultancy software project for the Department of Computer Science & Engineering at RUET, providing an account-based workspace for departmental consultancy activities.',
            'summary_bn' => 'RUET-এর Computer Science & Engineering বিভাগের কনসালটেন্সি কার্যক্রমের জন্য তৈরি একটি ওয়েবভিত্তিক সফটওয়্যার।',
            'problem_en' => 'The department needed a dedicated web application for its consultancy activities.',
            'solution_en' => 'A departmental consultancy platform with email/password sign-in, account registration and password recovery. Access to the application workspace is available through authenticated accounts.',
            'outcome_en' => 'The software is deployed on the official RUET CSE consultancy domain, providing a dedicated entry point for the department’s consultancy workspace.',
            'status' => 'active',
            'cover_path' => 'projects/consultancy-preview.png',
            'live_url' => 'https://consultancy.cse.ruet.ac.bd/',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 8,
        ]);
    }
}
