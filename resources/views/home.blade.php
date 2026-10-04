@extends('layouts.app')
@php
    $locale = request()->cookie('portfolio-language') === 'en' ? 'en' : 'bn';
    $profileImage = $profile?->image_path ?: 'images/sakib-portrait.jpg';
    $profileImageUrl = str_starts_with($profileImage, 'images/')
        ? asset($profileImage)
        : \Illuminate\Support\Facades\Storage::disk('public')->url($profileImage);
    $contactEmail = $settings->get('contact_email')?->{"value_{$locale}"} ?: config('site.email');
    $featuredProject = $projects->firstWhere('is_featured', true) ?? $projects->first();
@endphp
@section('title', ($profile?->name ?? config('site.name')).' · '.($profile?->getAttribute('creative_title_'.$locale) ?? 'Web Developer & IT Professional'))
@section('description', $profile?->getAttribute('intro_'.$locale) ?? config('site.description'))
@section('content')
<section class="container hero-editorial">
    <div class="hero-editorial-copy">
        <p class="eyebrow hero-eyebrow"><span class="status-dot"></span>{{ $profile?->getAttribute('title_'.$locale) ?? 'Senior Technical Officer · CSE, RUET' }}</p>
        <h1>{{ $profile?->getAttribute('creative_title_'.$locale) ?? ($locale === 'bn' ? 'ওয়েব ডেভেলপার ও আইটি পেশাজীবী' : 'Web Developer & IT Professional') }}</h1>
        <p class="hero-description">{{ $profile?->getAttribute('intro_'.$locale) ?? config('site.description') }}</p>
        <div class="hero-actions">
            <a class="button hero-button" href="#projects"><span>{{ $locale === 'bn' ? 'প্রকল্প দেখুন' : 'View selected work' }}</span><span class="button-arrow" aria-hidden="true">↗</span></a>
            <a class="hero-secondary-link" href="{{ route('contact') }}"><span>{{ $locale === 'bn' ? 'যোগাযোগ' : 'Get in touch' }}</span><span aria-hidden="true">→</span></a>
        </div>
        <div class="hero-social-links" aria-label="Social profiles">
            @foreach($socialLinks->take(4) as $link)
                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">{{ $link->label ?: $link->platform }} <span>↗</span></a>
            @endforeach
        </div>
    </div>
    <div class="hero-photo-wrap">
        <img class="hero-photo" src="{{ $profileImageUrl }}" alt="{{ $profile?->name ?? config('site.name') }}" fetchpriority="high">
        <span class="photo-index">RAJSHAHI · BANGLADESH<br><span>RUET · DEPARTMENT OF CSE</span></span>
        <div class="photo-caption"><span class="caption-initials">SA</span><span><strong>{{ $profile?->name ?? config('site.name') }}</strong><small>{{ $profile?->getAttribute('title_'.$locale) ?? 'Senior Technical Officer · RUET' }}</small></span><span class="caption-arrow" aria-hidden="true">↗</span></div>
    </div>
</section>

<div class="credential-strip"><div class="container credential-items">
    <span class="strip-label">{{ $locale === 'bn' ? 'পেশাগত পরিচয়' : 'PROFESSIONAL PROFILE' }}</span>
    <span>RUET <span class="strip-divider">/</span> CSE</span>
    <span>{{ $locale === 'bn' ? 'ওয়েব অ্যাপ্লিকেশন' : 'WEB APPLICATIONS' }}</span>
    <span>Laravel · WordPress</span>
    <span>{{ $locale === 'bn' ? 'রাজশাহী, বাংলাদেশ' : 'RAJSHAHI, BANGLADESH' }}</span>
</div></div>

<section class="container about-editorial" id="about">
    <div class="section-marker"><span>01</span><span>—</span><span>{{ $locale === 'bn' ? 'পরিচিতি' : 'ABOUT' }}</span></div>
    <div class="about-editorial-copy">
        <h2>{{ $locale === 'bn' ? 'প্রযুক্তি ও' : 'Technology for' }}<br><em>{{ $locale === 'bn' ? 'কার্যকর সমাধান।' : 'useful solutions.' }}</em></h2>
        <div class="about-detail">
            <p>{{ $profile?->getAttribute('about_'.$locale) ?? config('site.description') }}</p>
            <a class="inline-more-link" href="{{ route('about') }}"><span>{{ $locale === 'bn' ? 'পূর্ণ পরিচিতি' : 'More about me' }}</span><span>↗</span></a>
        </div>
    </div>
</section>

<section class="skills-section" id="expertise"><div class="container">
    <div class="section-marker"><span>02</span><span>—</span><span>{{ $locale === 'bn' ? 'দক্ষতা' : 'EXPERTISE' }}</span></div>
    <div class="skills-heading"><h2>{{ $locale === 'bn' ? 'যে প্রযুক্তি ও কাজে স্বচ্ছন্দ' : 'Tools I work with' }}</h2><p>{{ $locale === 'bn' ? 'অভিজ্ঞতা ও প্রকল্পে ব্যবহৃত প্রযুক্তি।' : 'Technologies reflected in my experience and work.' }}</p></div>
    <div class="skills-grid">
        @forelse($skills as $category)
            <article class="skill-group"><span class="skill-index">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $category->getAttribute('name_'.$locale) }}</h3><p>{{ $locale === 'bn' ? 'দক্ষতার ক্ষেত্র' : 'Area of practice' }}</p><div class="skill-tags">@foreach($category->skills as $skill)<span>{{ $skill->name }}</span>@endforeach</div></article>
        @empty
            <p>{{ $locale === 'bn' ? 'দক্ষতার তথ্য শিগগিরই যোগ করা হবে।' : 'Skills will be added soon.' }}</p>
        @endforelse
    </div>
</div></section>

<section class="projects-section" id="projects"><div class="container">
    <div class="section-marker"><span>03</span><span>—</span><span>{{ $locale === 'bn' ? 'নির্বাচিত প্রকল্প' : 'SELECTED PROJECTS' }}</span></div>
    <div class="projects-heading"><div><h2>{{ $locale === 'bn' ? 'বাস্তব প্রয়োজনের' : 'Built for' }}<br><em>{{ $locale === 'bn' ? 'জন্য তৈরি।' : 'real-world needs.' }}</em></h2></div><p>{{ $locale === 'bn' ? 'প্রাতিষ্ঠানিক কাজ থেকে ওয়েব অ্যাপ্লিকেশন—নির্বাচিত কাজ।' : 'Selected work, including institutional software and web applications.' }}</p></div>
    @if($featuredProject)
        <article class="featured-project">
            <div class="project-visual" aria-hidden="true"><div class="project-visual-top"><span>{{ $featuredProject->organization ?: 'SELECTED WORK' }}</span><span>PROJECT / 01</span></div><div class="inventory-mark"><span class="inventory-mark-square">R</span><span>WEB<br><strong>APPLICATION</strong></span></div><span class="visual-caption">{{ strtoupper($featuredProject->category) }} · {{ strtoupper($featuredProject->status) }}</span></div>
            <div class="project-description">
                <p class="project-kicker">{{ $featuredProject->organization ?: ($locale === 'bn' ? 'নির্বাচিত প্রকল্প' : 'SELECTED PROJECT') }}</p>
                <h3>{{ $featuredProject->getAttribute('title_'.$locale) }}</h3>
                <p>{{ $featuredProject->getAttribute('summary_'.$locale) }}</p>
                <div class="project-tech">@foreach($featuredProject->technologies as $technology)<span>{{ $technology->name }}</span>@endforeach</div>
                <div class="project-links">
                    <a class="project-link" href="{{ route('projects.show', $featuredProject->slug) }}"><span>{{ $locale === 'bn' ? 'বিস্তারিত' : 'Project details' }}</span><span>↗</span></a>
                    @if($featuredProject->live_url)<a class="project-link" href="{{ $featuredProject->live_url }}" target="_blank" rel="noopener noreferrer"><span>{{ $locale === 'bn' ? 'লাইভ সাইট' : 'Live site' }}</span><span>↗</span></a>@endif
                    @if($featuredProject->source_url)<a class="project-link" href="{{ $featuredProject->source_url }}" target="_blank" rel="noopener noreferrer"><span>{{ $locale === 'bn' ? 'সোর্স কোড' : 'Source code' }}</span><span>↗</span></a>@endif
                </div>
            </div>
        </article>
    @else
        <p>{{ $locale === 'bn' ? 'নির্বাচিত প্রকল্প শিগগিরই যোগ করা হবে।' : 'Selected projects will be added soon.' }}</p>
    @endif
    <div class="all-projects-link"><span>{{ $locale === 'bn' ? 'সব প্রকল্প' : 'Browse all projects' }}</span><a href="{{ route('projects.index') }}">{{ $locale === 'bn' ? 'প্রকল্প দেখুন' : 'Projects' }} <span>↗</span></a></div>
</div></section>

<section class="experience-section" id="experience"><div class="container">
    <div class="section-marker"><span>04</span><span>—</span><span>{{ $locale === 'bn' ? 'অভিজ্ঞতা ও শিক্ষা' : 'EXPERIENCE & EDUCATION' }}</span></div>
    <div class="experience-grid">
        <div class="timeline-column"><h2>{{ $locale === 'bn' ? 'পেশাগত অভিজ্ঞতা' : 'Experience' }}</h2>
            @forelse($experiences as $experience)
                <div class="timeline-entry"><span class="timeline-period">{{ $experience->started_at?->format('M Y') }} — {{ $experience->is_current ? ($locale === 'bn' ? 'বর্তমান' : 'PRESENT') : $experience->ended_at?->format('M Y') }}</span><div><h3>{{ $experience->getAttribute('title_'.$locale) }}</h3><p>{{ $experience->getAttribute('organization_'.$locale) }}</p>@if($experience->location)<span class="timeline-location">{{ $experience->location }}</span>@endif</div></div>
            @empty
                <p>{{ $locale === 'bn' ? 'অভিজ্ঞতার তথ্য শিগগিরই যোগ করা হবে।' : 'Experience details will be added soon.' }}</p>
            @endforelse
            @if($freelanceProfiles->isNotEmpty())
                <div class="timeline-entry"><span class="timeline-period">{{ $locale === 'bn' ? 'ফ্রিল্যান্স' : 'FREELANCE' }}</span><div><h3>{{ $locale === 'bn' ? 'WordPress Developer' : 'WordPress Developer' }}</h3>@foreach($freelanceProfiles as $freelance)<p><a href="{{ $freelance->profile_url }}" target="_blank" rel="noopener noreferrer">{{ $freelance->platform }} ↗</a></p>@endforeach</div></div>
            @endif
        </div>
        <div class="timeline-column education-column"><h2>{{ $locale === 'bn' ? 'শিক্ষা' : 'Education' }}</h2>
            @forelse($educations as $education)
                <div class="timeline-entry"><span class="timeline-period">{{ $education->started_year ? $education->started_year.' — ' : '' }}{{ $education->graduated_year }}</span><div><h3>{{ $education->getAttribute('degree_'.$locale) }}</h3><p>{{ $education->getAttribute('institution_'.$locale) }}</p></div></div>
            @empty
                <p>{{ $locale === 'bn' ? 'শিক্ষার তথ্য শিগগিরই যোগ করা হবে।' : 'Education details will be added soon.' }}</p>
            @endforelse
        </div>
    </div>
</div></section>

@if($musicItems->isNotEmpty())
<section class="music-preview container">
    <div class="section-marker"><span>05</span><span>—</span><span>{{ $locale === 'bn' ? 'সংগীত' : 'MUSIC' }}</span></div>
    @foreach($musicItems->where('is_featured', true)->take(1) as $music)
        <article class="music-preview-card"><img src="{{ str_starts_with($music->image_path ?? '', 'images/') ? asset($music->image_path) : ($music->image_path ? \Illuminate\Support\Facades\Storage::disk('public')->url($music->image_path) : asset('images/sakib-music.jpg')) }}" alt="{{ $music->getAttribute('title_'.$locale) }}" loading="lazy"><div><p class="eyebrow">{{ $locale === 'bn' ? 'কাজের বাইরে' : 'OUTSIDE OF WORK' }}</p><h2>{{ $music->getAttribute('title_'.$locale) }}</h2><p>{{ $music->getAttribute('description_'.$locale) }}</p><a href="{{ route('music.index') }}">{{ $locale === 'bn' ? 'সংগীত পরিচিতি' : 'Music and performance' }} ↗</a></div></article>
    @endforeach
</section>
@endif

<section class="contact-editorial" id="contact"><div class="container contact-editorial-inner">
    <div><div class="section-marker"><span>06</span><span>—</span><span>{{ $locale === 'bn' ? 'যোগাযোগ' : 'CONTACT' }}</span></div><h2>{{ $locale === 'bn' ? 'চলুন, কথা বলি।' : 'Let’s get in touch.' }}</h2><p>{{ $locale === 'bn' ? 'পেশাগত কাজ, প্রযুক্তি অথবা সংগীত নিয়ে যোগাযোগ করতে পারেন।' : 'Get in touch about professional work, technology, or music.' }}</p><a class="contact-email-link" href="mailto:{{ $contactEmail }}">{{ $contactEmail }} <span>↗</span></a></div>
    <div class="contact-quick-links">
        @foreach($settings->only(['institutional_email', 'phone', 'office']) as $key => $setting)
            <a href="{{ $key === 'phone' ? 'tel:'.preg_replace('/[^+0-9]/', '', $setting->value_en) : ($key === 'office' ? route('contact') : 'mailto:'.$setting->value_en) }}"><span>{{ strtoupper(str_replace('_', ' ', $key)) }}</span><strong>{{ $setting->getAttribute('value_'.$locale) }}</strong></a>
        @endforeach
        @foreach($socialLinks->whereIn('platform', ['LinkedIn', 'Facebook'])->take(2) as $link)
            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"><span>{{ strtoupper($link->platform) }}</span><strong>{{ $link->label ?: $link->platform }} ↗</strong></a>
        @endforeach
    </div>
</div></section>
@endsection
