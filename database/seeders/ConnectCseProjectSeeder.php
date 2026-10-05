<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ConnectCseProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::updateOrCreate(['slug' => 'connect-cse-ruet'], [
            'title_en' => 'Connect CSE - Department Management System',
            'title_bn' => 'Connect CSE — বিভাগ ব্যবস্থাপনা সিস্টেম',
            'category' => 'software',
            'organization' => 'RUET CSE Department',
            'role' => 'Co-developer & Maintainer',
            'summary_en' => 'A department management platform for RUET CSE, bringing academic schedules, student support, administrative workflows and accounts together. The dashboard credits development and maintenance to Shuvo & Arnab.',
            'summary_bn' => 'RUET CSE বিভাগের একাডেমিক কার্যক্রম, শিক্ষার্থী সহায়তা, প্রশাসনিক কাজ ও হিসাব ব্যবস্থাপনার একটি সমন্বিত প্ল্যাটফর্ম।',
            'problem_en' => 'The department needed a central place to coordinate academic resources, schedules, student information, announcements and administrative tasks.',
            'solution_en' => 'Connect CSE organises these activities in a dashboard with academic, management and finance modules, alongside user administration, roles and permissions, notifications and audit logs.',
            'outcome_en' => 'The deployed platform provides a shared departmental workspace. Its dashboard presents student, teacher, course and pending complaint totals, today’s classes and shortcuts to frequently used administrative tools.',
            'status' => 'active',
            'cover_path' => 'projects/connectcse-preview.png',
            'live_url' => 'https://connectcse.ruet.ac.bd/dashboard',
            'source_url' => 'https://github.com/snarnab/connectcse',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 3,
        ]);
    }
}
