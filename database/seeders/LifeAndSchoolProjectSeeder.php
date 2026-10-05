<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class LifeAndSchoolProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::updateOrCreate(['slug' => 'prottasha-school-management'], [
            'title_en' => 'Prottasha - School Management System',
            'title_bn' => 'Prottasha — স্কুল ব্যবস্থাপনা সিস্টেম',
            'category' => 'web',
            'organization' => 'Prottasha',
            'role' => 'Developer',
            'summary_en' => 'A school management website developed by Sakib Nihal Arnab, covering fingerprint-based attendance, student management and examination results.',
            'summary_bn' => 'সাকিব নিহাল অর্ণবের তৈরি স্কুল ব্যবস্থাপনা ওয়েবসাইট। ফিঙ্গারপ্রিন্ট উপস্থিতি, শিক্ষার্থী ব্যবস্থাপনা ও পরীক্ষার ফলাফল এর মূল কার্যক্রম।',
            'problem_en' => 'Schools need an organised way to manage student attendance and academic records while keeping guardians informed about arrival and departure.',
            'solution_en' => 'Prottasha brings fingerprint attendance, student identity displays and guardian arrival/departure notifications together with school administration and result management.',
            'outcome_en' => 'A dedicated school platform with a public attendance demonstration and account access. The public homepage illustrates the attendance workflow and presents student, class/routine and examination/result modules in its roadmap.',
            'status' => 'active',
            'cover_path' => 'projects/prottasha-preview.png',
            'live_url' => 'https://prottasha.naznins.xyz/',
            'source_url' => 'https://github.com/snarnab/prottasha',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 6,
        ]);

        Project::updateOrCreate(['slug' => 'dailylife-task-management'], [
            'title_en' => 'DailyLife - Personal & Team Task Management',
            'title_bn' => 'DailyLife — ব্যক্তিগত ও দলীয় কাজ ব্যবস্থাপনা',
            'category' => 'web',
            'organization' => 'DailyLife',
            'role' => 'Developer',
            'summary_en' => 'A daily planning application developed by Sakib Nihal Arnab for personal and group tasks, team collaboration and scheduled Telegram reminders, alongside calendars, notes, birthdays and files.',
            'summary_bn' => 'সাকিব নিহাল অর্ণবের তৈরি দৈনন্দিন পরিকল্পনা অ্যাপ। ব্যক্তিগত ও দলীয় কাজ, নির্দিষ্ট সময়ে Telegram reminder, calendar, notes এবং files একসঙ্গে পরিচালনা করা যায়।',
            'problem_en' => 'Personal commitments and shared team responsibilities need clear priorities, due dates and timely reminders in one accessible workspace.',
            'solution_en' => 'DailyLife combines a My Day dashboard, personal and group tasks, team spaces and scheduled Telegram notifications with calendar planning, meetings, notes, contacts, audio and file sections.',
            'outcome_en' => 'The dashboard brings due, overdue, urgent and upcoming work into one daily view, with completion summaries, team progress, birthdays and a Google Calendar overview.',
            'status' => 'active',
            'cover_path' => 'projects/dailylife-preview.png',
            'live_url' => 'https://dailylife.naznins.xyz/dashboard',
            'source_url' => 'https://github.com/snarnab/dailylife',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 7,
        ]);
    }
}
