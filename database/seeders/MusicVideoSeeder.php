<?php

namespace Database\Seeders;

use App\Models\MusicItem;
use Illuminate\Database\Seeder;

class MusicVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = [
            ['l_Bagz7blds', 'Tomar Tane Sarabelar Gane', 'Tomar Tane Sarabelar Gane - Rupankar | তোমার টানে । Cover। Sakib Nihal Arnab | Bangla Romantic Song'],
            ['jeOvZRI7ok8', 'Akasher Sob Tara', 'Akasher Sob Tara । আকাশের সব তারা । Topon Chowdhury | Cover | Sakib Nihal Arnab | বাংলা আধুনিক গান'],
            ['V8WOD2oIHQY', 'Ajo Hridoye Valobeshe', 'Ajo Hridoye Valobeshe | আজো হৃদয়ে ভালোবেসে। Cover | Sakib Nihal Arnab | Romantic Adhunik Bangla Song'],
            ['qNblCRPrA9s', 'Ami Jamini Tumi Shashi Hey', 'Ami Jamini Tumi Shashi Hey | আমি যামিনী তুমি শশী হে | Sakib Nihal Arnab | Cover | Manna Dey'],
            ['BtXXpXkZNM8', 'Kano Fire Jai Bedonai', 'Kano Fire Jai Bedonai || কেন ফিরে যায় বেদনায় || Manna Dey || Cover By Sakib Nihal Arnab'],
            ['QshH5WAaC3E', 'Eto Jol O Kajol', 'Eto Jol O Kajol || এত জল ও কাজল ।। কাজী নজরুল ইসলাম ।। Sakib Nihal Arnab'],
            ['GAgqTSjbBmI', 'Amar Valobashar Tanpura', 'Amar Valobashar Tanpura (আমার ভালোবাসার তানপুরা) #Different Touch #Cover #Sakib Nihal Arnab #Ovick'],
            ['tt_KZWkAjp0', 'Je Akhite Eto Hasi Lukano', 'Je Akhite Eto Hasi Lukano (যে আঁখিতে এত হাসি) #Talat Mahmud #Cover #Sakib Nihal Arnab #Old Bangla Song'],
            ['p4S-hzrvPHk', 'Sondhe Namar Age', 'Sondhe Namar Age #Bidai Bomkesh #Arnab #Cover'],
            ['3izWqpV3_8Q', 'Shudhu Tomar Jonno', 'Shudhu Tomar Jonno #Dhrubo #Cover #Sakib Nihal Arnab #Mohtasin Ovick'],
            ['usFEUiRnHkU', 'Darie Accho Tumi Amar Ganer Opare', 'Darie Accho Tumi Amar Ganer Opare #Cover #Arnab (With English Translation) #Rabindra Sangeet'],
        ];

        foreach ($videos as $index => [$videoId, $title, $youtubeTitle]) {
            MusicItem::updateOrCreate(
                ['youtube_url' => 'https://www.youtube.com/watch?v='.$videoId],
                [
                    'title_en' => $title,
                    'title_bn' => $title,
                    'description_en' => $youtubeTitle,
                    'is_featured' => $index === 0,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }

        MusicItem::updateOrCreate(
            ['facebook_url' => 'https://www.facebook.com/sakibnarnab/reels/'],
            [
                'title_en' => 'Facebook Reels',
                'title_bn' => 'Facebook Reels',
                'description_en' => 'Watch Sakib Nihal Arnab’s latest music performances and video reels on Facebook.',
                'image_path' => 'images/sakib-music.jpg',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => count($videos) + 1,
            ],
        );

        MusicItem::query()
            ->where('youtube_url', 'https://www.youtube.com/@sakibnihalarnab')
            ->delete();
    }
}
