<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Seeder;

class TradingAiProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = Project::updateOrCreate(['slug' => 'ai-trading-dashboard'], [
            'title_en' => 'AI Trading - Market Analysis & Signal Dashboard',
            'title_bn' => 'AI Trading — বাজার বিশ্লেষণ ও ট্রেডিং সিগন্যাল',
            'category' => 'web',
            'organization' => 'AI Trading',
            'role' => 'Developer',
            'summary_en' => 'A trading analysis web application developed by Sakib Nihal Arnab that analyses charts, identifies buy and sell setups, and delivers signal notifications through the website and a Telegram group.',
            'summary_bn' => 'সাকিব নিহাল অর্ণবের তৈরি ট্রেডিং বিশ্লেষণ ওয়েব অ্যাপ্লিকেশন। চার্ট বিশ্লেষণ করে buy ও sell সিগন্যাল শনাক্ত করে ওয়েবসাইট এবং Telegram গ্রুপে বিজ্ঞপ্তি পাঠায়।',
            'problem_en' => 'Monitoring several market charts and keeping track of new trade setups requires a central analysis and notification workflow.',
            'solution_en' => 'An AI-assisted analysis workflow with a multi-symbol M15 scanner and Rule Engine V2. The dashboard presents buy, sell and no-trade states, setup grades, entry prices, stop-loss and target levels, with website notifications and Telegram alerts.',
            'outcome_en' => 'A deployed dashboard brings market setups, active trade tracking and signal records into one interface, with separate views for history, signals, statistics and performance.',
            'status' => 'active',
            'cover_path' => 'projects/trading-ai-preview.png',
            'live_url' => 'https://trade.naznins.xyz/dashboard',
            'source_url' => 'https://github.com/snarnab/trading-ai',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 5,
        ]);

        $technologies = collect(['Laravel', 'PHP', 'Blade'])->map(
            fn (string $name): Technology => Technology::updateOrCreate(['name' => $name], []),
        );
        $project->technologies()->sync($technologies->pluck('id')->all());
    }
}
