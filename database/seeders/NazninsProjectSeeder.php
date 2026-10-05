<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class NazninsProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::updateOrCreate(['slug' => 'naznins-ecommerce'], [
            'title_en' => 'Naznins — E-commerce Website',
            'title_bn' => 'Naznins — ই-কমার্স ওয়েবসাইট',
            'category' => 'web',
            'organization' => 'Naznins',
            'role' => 'Developer',
            'summary_en' => 'An e-commerce website by Sakib Nihal Arnab, bringing product browsing, search, a shopping cart and customer accounts together in a responsive online storefront.',
            'summary_bn' => 'সাকিব নিহাল অর্ণবের তৈরি একটি ই-কমার্স ওয়েবসাইট, যেখানে পণ্য দেখা, অনুসন্ধান, শপিং কার্ট ও গ্রাহক অ্যাকাউন্টের সুবিধা রয়েছে।',
            'problem_en' => 'Naznins needed an online storefront where customers could discover products and access shopping features from desktop and mobile devices.',
            'solution_en' => 'A responsive storefront with a product catalogue, live search suggestions, shopping cart and customer account navigation. Promotional slides and product listings help visitors explore the store.',
            'outcome_en' => 'The Naznins storefront is available at www.naznins.xyz, providing a dedicated online presence for the brand and a central place to browse its products.',
            'status' => 'active',
            'cover_path' => 'projects/naznins-homepage.png',
            'live_url' => 'https://www.naznins.xyz',
            'source_url' => 'https://github.com/snarnab/naznins',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 2,
        ]);
    }
}
