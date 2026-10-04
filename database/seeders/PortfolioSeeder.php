<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use App\Models\FreelanceProfile;
use App\Models\MusicItem;
use App\Models\PhotographyCategory;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SocialLink;
use App\Models\Technology;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        Profile::updateOrCreate(['id' => 1], [
            'name' => 'Sakib Nihal Arnab',
            'title_bn' => 'সিনিয়র টেকনিক্যাল অফিসার · CSE, RUET',
            'title_en' => 'Senior Technical Officer · CSE, RUET',
            'creative_title_bn' => 'ওয়েব ডেভেলপার ও আইটি পেশাজীবী',
            'creative_title_en' => 'Web Developer & IT Professional',
            'intro_bn' => 'আমি সাকিব নিহাল আরনাব। RUET-এর CSE বিভাগে সিনিয়র টেকনিক্যাল অফিসার হিসেবে কাজ করি এবং বাস্তব প্রয়োজনের জন্য ওয়েব অ্যাপ্লিকেশন তৈরি করি।',
            'intro_en' => 'I am Sakib Nihal Arnab, a Senior Technical Officer in RUET’s CSE department who builds web applications for real-world needs.',
            'about_bn' => 'রাজশাহী প্রকৌশল ও প্রযুক্তি বিশ্ববিদ্যালয়ের CSE বিভাগে প্রাতিষ্ঠানিক প্রযুক্তি সেবায় কাজ করি। পাশাপাশি Laravel, PHP ও WordPress দিয়ে ওয়েব অ্যাপ্লিকেশন ও সাইট তৈরি করি। রাজশাহী বেতারের রবীন্দ্রসংগীত শিল্পী হিসেবেও সংগীতচর্চা করি।',
            'about_en' => 'I work in institutional technology at the Department of CSE, Rajshahi University of Engineering & Technology. I also build web applications and websites with Laravel, PHP, and WordPress, and perform Rabindra Sangeet with Rajshahi Betar.',
            'location' => 'Rajshahi, Bangladesh',
            'image_path' => 'images/sakib-portrait.jpg',
        ]);

        Experience::updateOrCreate(['title_en' => 'Senior Technical Officer', 'organization_en' => 'Department of CSE, RUET'], [
            'title_bn' => 'সিনিয়র টেকনিক্যাল অফিসার',
            'organization_bn' => 'CSE বিভাগ, RUET',
            'location' => 'Rajshahi, Bangladesh',
            'employment_type' => 'employment',
            'started_at' => '2021-06-01',
            'is_current' => true,
            'details_en' => 'Institutional IT role in the Department of CSE at Rajshahi University of Engineering & Technology.',
            'details_bn' => 'রাজশাহী প্রকৌশল ও প্রযুক্তি বিশ্ববিদ্যালয়ের CSE বিভাগে প্রাতিষ্ঠানিক আইটি-সংক্রান্ত পেশাগত দায়িত্ব।',
            'sort_order' => 1,
        ]);

        Education::updateOrCreate(['degree_en' => 'M.Sc. in Computer Science & Engineering'], [
            'degree_bn' => 'কম্পিউটার সায়েন্স অ্যান্ড ইঞ্জিনিয়ারিংয়ে এম.এসসি.',
            'institution_en' => 'University of Rajshahi',
            'institution_bn' => 'রাজশাহী বিশ্ববিদ্যালয়',
            'field_of_study' => 'Computer Science & Engineering',
            'graduated_year' => 2025,
            'sort_order' => 1,
        ]);
        Education::updateOrCreate(['degree_en' => 'B.Sc. in Computer Science & Engineering'], [
            'degree_bn' => 'কম্পিউটার সায়েন্স অ্যান্ড ইঞ্জিনিয়ারিংয়ে বি.এসসি.',
            'institution_en' => 'Bangladesh Army University of Engineering & Technology',
            'institution_bn' => 'বাংলাদেশ আর্মি ইউনিভার্সিটি অব ইঞ্জিনিয়ারিং অ্যান্ড টেকনোলজি',
            'field_of_study' => 'Computer Science & Engineering',
            'started_year' => 2015,
            'graduated_year' => 2019,
            'sort_order' => 2,
        ]);
        $this->call(SchoolEducationSeeder::class);

        $webCategory = SkillCategory::updateOrCreate(['name_en' => 'Web Development'], [
            'name_bn' => 'ওয়েব ডেভেলপমেন্ট',
            'sort_order' => 1,
        ]);
        foreach (['PHP', 'Laravel', 'WordPress', 'HTML & CSS', 'JavaScript'] as $order => $skillName) {
            Skill::updateOrCreate(['skill_category_id' => $webCategory->id, 'name' => $skillName], [
                'sort_order' => $order + 1,
            ]);
        }

        $technologies = collect(['Laravel', 'PHP', 'Blade'])->map(
            fn (string $name): Technology => Technology::updateOrCreate(['name' => $name], []),
        );
        $project = Project::updateOrCreate(['slug' => 'ruet-cse-inventory-system'], [
            'title_en' => 'RUET CSE Inventory System',
            'title_bn' => 'RUET CSE ইনভেন্টরি সিস্টেম',
            'category' => 'software',
            'organization' => 'Department of CSE, RUET',
            'role' => 'Developer',
            'summary_en' => 'An inventory management application developed for the Department of CSE at RUET.',
            'summary_bn' => 'RUET-এর CSE বিভাগের জন্য তৈরি একটি ইনভেন্টরি ম্যানেজমেন্ট অ্যাপ্লিকেশন।',
            'problem_en' => 'The department needed a digital system to manage its inventory.',
            'problem_bn' => 'বিভাগের ইনভেন্টরি ব্যবস্থাপনার জন্য একটি ডিজিটাল সিস্টেমের প্রয়োজন ছিল।',
            'solution_en' => 'A web-based inventory system built for the department’s operational needs.',
            'solution_bn' => 'বিভাগের কাজের প্রয়োজন অনুযায়ী একটি ওয়েবভিত্তিক ইনভেন্টরি সিস্টেম তৈরি করা হয়েছে।',
            'status' => 'active',
            'live_url' => 'https://rcis.ruet.ac.bd/login',
            'source_url' => 'https://github.com/snarnab/RCIS',
            'is_published' => true,
            'is_featured' => true,
            'sort_order' => 1,
        ]);
        $project->technologies()->sync($technologies->pluck('id')->all());

        FreelanceProfile::updateOrCreate(['platform' => 'Freelancer.com'], [
            'profile_url' => 'https://www.freelancer.pk/u/snarnab',
            'service_en' => 'WordPress Developer',
            'service_bn' => 'ওয়ার্ডপ্রেস ডেভেলপার',
            'details_en' => 'Freelance WordPress development experience listed in my professional CV.',
            'details_bn' => 'আমার পেশাগত CV-তে উল্লেখিত WordPress development-এর freelance অভিজ্ঞতা।',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        PhotographyCategory::updateOrCreate(['slug' => 'personal'], [
            'name_en' => 'Personal',
            'name_bn' => 'ব্যক্তিগত',
            'sort_order' => 1,
        ]);
        MusicItem::updateOrCreate(['title_en' => 'Rabindra Sangeet'], [
            'title_bn' => 'রবীন্দ্রসংগীত',
            'description_en' => 'I perform Rabindra Sangeet with Rajshahi Betar.',
            'description_bn' => 'রাজশাহী বেতারের রবীন্দ্রসংগীত শিল্পী হিসেবে সংগীতচর্চা করি।',
            'youtube_url' => 'https://www.youtube.com/@sakibnihalarnab',
            'image_path' => 'images/sakib-music.jpg',
            'is_featured' => true,
            'is_published' => true,
            'sort_order' => 1,
        ]);

        foreach ([
            ['platform' => 'LinkedIn', 'url' => 'https://bd.linkedin.com/in/sakib-nihal-arnab-543b58107'],
            ['platform' => 'GitHub', 'url' => 'https://github.com/snarnab?tab=repositories'],
            ['platform' => 'Facebook', 'url' => 'https://www.facebook.com/sakibnarnab/'],
            ['platform' => 'YouTube', 'url' => 'https://www.youtube.com/@sakibnihalarnab'],
        ] as $order => $link) {
            SocialLink::updateOrCreate(['platform' => $link['platform']], [
                'url' => $link['url'],
                'sort_order' => $order + 1,
            ]);
        }

        foreach ([
            'contact_email' => ['sakibnihalarnab@gmail.com', 'sakibnihalarnab@gmail.com'],
            'institutional_email' => ['sakibnihalarnab@cse.ruet.ac.bd', 'sakibnihalarnab@cse.ruet.ac.bd'],
            'phone' => ['+880 1752-309936', '+880 1752-309936'],
            'office' => ['Room 126, Ground Floor, RUET CSE Building, Rajshahi', 'কক্ষ ১২৬, Ground Floor, RUET CSE Building, রাজশাহী'],
        ] as $key => [$valueEn, $valueBn]) {
            SiteSetting::updateOrCreate(['key' => $key], [
                'value_en' => $valueEn,
                'value_bn' => $valueBn,
            ]);
        }
    }
}
