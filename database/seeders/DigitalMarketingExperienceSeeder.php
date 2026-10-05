<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class DigitalMarketingExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::updateOrCreate([
            'title_en' => 'Digital Marketing Expert',
            'organization_en' => 'E² Media',
        ], [
            'title_bn' => 'ডিজিটাল মার্কেটিং বিশেষজ্ঞ',
            'organization_bn' => 'ই স্কয়ার মিডিয়া',
            'employment_type' => 'freelance',
            'started_at' => '2019-12-19',
            'ended_at' => '2021-05-31',
            'is_current' => false,
            'details_en' => 'Sakib Nihal Arnab served as a Digital Marketing Expert at E² Media, supporting its digital marketing activities through a freelance engagement.',
            'details_bn' => 'সাকিব নিহাল আরনাব E² Media-তে ডিজিটাল মার্কেটিং বিশেষজ্ঞ হিসেবে ফ্রিল্যান্স ভিত্তিতে প্রতিষ্ঠানটির ডিজিটাল মার্কেটিং কার্যক্রমে কাজ করেছেন।',
            'sort_order' => 2,
        ]);
    }
}
