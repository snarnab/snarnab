<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class LyricsProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::updateOrCreate(['slug' => 'lyrics-notebook'], [
            'title_en' => 'Lyrics Notebook - Song Library Management',
            'title_bn' => 'Lyrics Notebook — গানের লাইব্রেরি ব্যবস্থাপনা',
            'category' => 'web',
            'organization' => 'Lyrics Notebook',
            'role' => 'Developer',
            'summary_en' => 'A personal song lyrics library developed by Sakib Nihal Arnab for organising lyrics by category, finding favourite songs and preparing lyrics for download and print.',
            'summary_bn' => 'সাকিব নিহাল অর্ণবের তৈরি গানের লিরিক্স সংরক্ষণ ও ব্যবস্থাপনার ওয়েব অ্যাপ্লিকেশন। বিভাগ অনুযায়ী গান সাজানো, অনুসন্ধান, প্রিয় গান সংরক্ষণ, ডাউনলোড ও প্রিন্টের সুবিধা রয়েছে।',
            'problem_en' => 'A growing collection of song lyrics needs an organised, searchable home that also supports practice and preparation for performances.',
            'solution_en' => 'Lyrics Notebook brings category browsing, song and collection management, favourites, search, musical key summaries, trash and print/export tools into one personal library, with language and theme controls.',
            'outcome_en' => 'The application provides a dedicated workspace for keeping song lyrics organised and ready to revisit, download or print for practice and performance.',
            'status' => 'active',
            'cover_path' => 'projects/lyrics-preview.png',
            'live_url' => 'https://lyrics.naznins.xyz/login',
            'source_url' => 'https://github.com/snarnab/lyrics',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 4,
        ]);
    }
}
