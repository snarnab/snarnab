<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class NposProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::updateOrCreate(['slug' => 'npos-inventory-management'], [
            'title_en' => 'NPOS - Inventory & POS Management System',
            'title_bn' => 'NPOS — ইনভেন্টরি ও POS ব্যবস্থাপনা সিস্টেম',
            'category' => 'software',
            'organization' => 'Naznins Inventory System',
            'role' => 'Developer',
            'summary_en' => 'An inventory and point-of-sale management system developed by Sakib Nihal Arnab for Naznins, bringing products, stock, orders, customers, shipments and profit reporting together.',
            'summary_bn' => 'সাকিব নিহাল অর্ণবের তৈরি Naznins-এর ইনভেন্টরি ও POS ব্যবস্থাপনা সিস্টেম। পণ্য, স্টক, অর্ডার, গ্রাহক, শিপমেন্ট ও লাভের হিসাব একসঙ্গে পরিচালনার সুবিধা রয়েছে।',
            'problem_en' => 'Retail operations need a central workspace to track products, stock availability, sales, customer records and incoming shipments alongside expenses and profit.',
            'solution_en' => 'NPOS combines POS creation and product management with order summaries, negative-stock reporting, customer and location sections, shipment workflows, expenses and profit reporting. Its dashboard highlights daily orders, total orders, items sold, notifications and top-selling products.',
            'outcome_en' => 'A dedicated inventory workspace provides an overview of orders, stock and activity, including seven-day top-selling products and a monthly manager-wise delivery summary.',
            'status' => 'active',
            'cover_path' => 'projects/npos-preview.png',
            'live_url' => 'https://pos.naznins.xyz/dashboard',
            'source_url' => 'https://github.com/snarnab/npos',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 9,
        ]);
    }
}
