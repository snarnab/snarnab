<?php

namespace Database\Seeders;

use App\Models\FreelanceProfile;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class FreelanceProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FreelanceProfile::updateOrCreate(['platform' => 'Freelancer.com'], [
            'profile_url' => 'https://www.freelancer.com.bd/u/SNArnab',
            'service_en' => 'Web Designer & Developer · WordPress Expert',
            'service_bn' => 'ওয়েব ডিজাইনার ও ডেভেলপার · ওয়ার্ডপ্রেস বিশেষজ্ঞ',
            'details_en' => 'Web design and development with WordPress, PHP, and Laravel, graphic design and photo editing, data entry, lead generation, keyword research, and social media marketing. Rated 5.0/5 from 22 reviews. Member since February 9, 2020; listed rate: $3 USD/hour. Updated October 5, 2026.',
            'details_bn' => 'সাকিব নিহাল আরনাব WordPress, PHP ও Laravel দিয়ে ওয়েবসাইট ডিজাইন ও ডেভেলপমেন্টের পাশাপাশি গ্রাফিক ডিজাইন, ডেটা এন্ট্রি, লিড জেনারেশন, কিওয়ার্ড রিসার্চ ও সোশ্যাল মিডিয়া মার্কেটিং সেবা প্রদান করেন।',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        FreelanceProfile::updateOrCreate(['platform' => 'Fiverr'], [
            'profile_url' => 'https://www.fiverr.com/s_n_arnab',
            'service_en' => 'Social Media Promoter and Graphics Designer',
            'service_bn' => 'সোশ্যাল মিডিয়া প্রোমোটার ও গ্রাফিক ডিজাইনার',
            'details_en' => 'Graphic design, photo editing, social media marketing, WordPress, data entry, and web research. Rated 4.9/5 from 63 reviews, with 110+ completed orders and 100% on-time delivery. Updated October 5, 2026.',
            'details_bn' => 'গ্রাফিক ডিজাইন, ফটো এডিটিং, সোশ্যাল মিডিয়া মার্কেটিং, WordPress, ডেটা এন্ট্রি ও ওয়েব রিসার্চ। ৬৩টি রিভিউয়ে ৪.৯/৫ রেটিং, ১১০টির বেশি অর্ডার সম্পন্ন ও ১০০% সময়মতো ডেলিভারি। আপডেট: ৫ অক্টোবর ২০২৬।',
            'is_published' => true,
            'sort_order' => 2,
        ]);

        foreach ([
            ['platform' => 'Freelancer.com', 'url' => 'https://www.freelancer.com.bd/u/SNArnab', 'sort_order' => 5],
            ['platform' => 'Fiverr', 'url' => 'https://www.fiverr.com/s_n_arnab', 'sort_order' => 6],
        ] as $link) {
            SocialLink::updateOrCreate(['platform' => $link['platform']], $link);
        }
    }
}
