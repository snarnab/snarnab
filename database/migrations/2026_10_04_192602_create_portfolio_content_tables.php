<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('title_bn');
            $table->string('title_en');
            $table->string('creative_title_bn')->nullable();
            $table->string('creative_title_en')->nullable();
            $table->text('intro_bn');
            $table->text('intro_en');
            $table->text('about_bn');
            $table->text('about_en');
            $table->string('location')->default('Rajshahi, Bangladesh');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        Schema::create('experiences', function (Blueprint $table): void {
            $table->id();
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('organization_en');
            $table->string('organization_bn');
            $table->string('location')->nullable();
            $table->string('employment_type')->default('employment');
            $table->date('started_at')->nullable();
            $table->date('ended_at')->nullable();
            $table->boolean('is_current')->default(false);
            $table->text('details_en')->nullable();
            $table->text('details_bn')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('educations', function (Blueprint $table): void {
            $table->id();
            $table->string('degree_en');
            $table->string('degree_bn');
            $table->string('institution_en');
            $table->string('institution_bn');
            $table->string('field_of_study')->nullable();
            $table->unsignedSmallInteger('started_year')->nullable();
            $table->unsignedSmallInteger('graduated_year')->nullable();
            $table->text('details_en')->nullable();
            $table->text('details_bn')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('skill_categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name_en');
            $table->string('name_bn');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('skill_category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('category')->default('web');
            $table->string('organization')->nullable();
            $table->string('role')->nullable();
            $table->text('summary_en');
            $table->text('summary_bn');
            $table->text('problem_en')->nullable();
            $table->text('problem_bn')->nullable();
            $table->text('solution_en')->nullable();
            $table->text('solution_bn')->nullable();
            $table->text('outcome_en')->nullable();
            $table->text('outcome_bn')->nullable();
            $table->unsignedSmallInteger('development_year')->nullable();
            $table->string('status')->default('active');
            $table->string('cover_path')->nullable();
            $table->string('live_url', 2048)->nullable();
            $table->string('source_url', 2048)->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('technologies', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('project_technology', function (Blueprint $table): void {
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('technology_id')->constrained()->cascadeOnDelete();
            $table->primary(['project_id', 'technology_id']);
        });

        Schema::create('project_images', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->string('alt_en')->nullable();
            $table->string('alt_bn')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('freelance_profiles', function (Blueprint $table): void {
            $table->id();
            $table->string('platform');
            $table->string('profile_url', 2048);
            $table->string('service_en');
            $table->string('service_bn');
            $table->text('details_en')->nullable();
            $table->text('details_bn')->nullable();
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('music_items', function (Blueprint $table): void {
            $table->id();
            $table->string('title_en');
            $table->string('title_bn');
            $table->text('description_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->string('youtube_url', 2048)->nullable();
            $table->string('facebook_url', 2048)->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('photography_categories', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name_en');
            $table->string('name_bn');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('photographs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('photography_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->string('image_path');
            $table->string('location')->nullable();
            $table->unsignedSmallInteger('photographed_year')->nullable();
            $table->text('story_en')->nullable();
            $table->text('story_bn')->nullable();
            $table->string('camera')->nullable();
            $table->string('lens')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('social_links', function (Blueprint $table): void {
            $table->id();
            $table->string('platform');
            $table->string('label')->nullable();
            $table->string('url', 2048);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('site_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique();
            $table->text('value_en')->nullable();
            $table->text('value_bn')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('social_links');
        Schema::dropIfExists('photographs');
        Schema::dropIfExists('photography_categories');
        Schema::dropIfExists('music_items');
        Schema::dropIfExists('freelance_profiles');
        Schema::dropIfExists('project_images');
        Schema::dropIfExists('project_technology');
        Schema::dropIfExists('technologies');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('skill_categories');
        Schema::dropIfExists('educations');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('profiles');
    }
};
