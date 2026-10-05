<?php

namespace Database\Seeders;

use App\Models\MusicItem;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ThirdPersonContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::query()->update([
            'intro_en' => 'Sakib Nihal Arnab is a Senior Technical Officer in RUET’s CSE department and develops web applications for practical needs.',
            'intro_bn' => 'সাকিব নিহাল আরনাব RUET-এর CSE বিভাগের সিনিয়র টেকনিক্যাল অফিসার। তিনি বাস্তব প্রয়োজনের জন্য ওয়েব অ্যাপ্লিকেশন তৈরি করেন।',
            'about_en' => 'Sakib Nihal Arnab serves in institutional technology at the Department of CSE, Rajshahi University of Engineering & Technology. His expertise spans Laravel, PHP, and WordPress development. Alongside his technical career, he performs Rabindra Sangeet with Rajshahi Betar.',
            'about_bn' => 'সাকিব নিহাল আরনাব রাজশাহী প্রকৌশল ও প্রযুক্তি বিশ্ববিদ্যালয়ের CSE বিভাগে প্রাতিষ্ঠানিক প্রযুক্তি সেবায় কর্মরত। তিনি Laravel, PHP ও WordPress দিয়ে ওয়েব অ্যাপ্লিকেশন ও সাইট তৈরি করেন। পাশাপাশি রাজশাহী বেতারের রবীন্দ্রসংগীত শিল্পী হিসেবে সংগীতচর্চা করেন।',
        ]);

        MusicItem::query()->where('title_en', 'Rabindra Sangeet')->update([
            'description_en' => 'Sakib Nihal Arnab performs Rabindra Sangeet with Rajshahi Betar.',
            'description_bn' => 'সাকিব নিহাল আরনাব রাজশাহী বেতারের রবীন্দ্রসংগীত শিল্পী হিসেবে সংগীতচর্চা করেন।',
        ]);
    }
}
