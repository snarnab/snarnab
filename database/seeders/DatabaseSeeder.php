<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(PortfolioSeeder::class);
        $this->call(DigitalMarketingExperienceSeeder::class);
        $this->call(NazninsProjectSeeder::class);
        $this->call(RuetProjectPreviewSeeder::class);
        $this->call(ConnectCseProjectSeeder::class);
        $this->call(LyricsProjectSeeder::class);
        $this->call(TradingAiProjectSeeder::class);
        $this->call(LifeAndSchoolProjectSeeder::class);
        $this->call(ConsultancyProjectSeeder::class);
        $this->call(TechnicalSkillsSeeder::class);
        $this->call(NposProjectSeeder::class);
    }
}
