@extends('layouts.app')
@php
    $profileImage = $profile?->image_path ?: 'images/sakib-portrait.jpg';
    $profileImageUrl = str_starts_with($profileImage, 'images/')
        ? asset($profileImage)
        : \Illuminate\Support\Facades\Storage::disk('public')->url($profileImage);
    $contactEmail = $settings->get('contact_email')?->value_en ?: config('site.email');
    $featuredProject = $projects->firstWhere('is_featured', true) ?? $projects->first();
    $featuredMusic = $musicItems->firstWhere('is_featured', true) ?? $musicItems->first();
@endphp
@section('title', 'Software & Web Developer')
@section('description', $profile?->intro_en ?? 'Sakib Nihal Arnab — Senior Technical Officer in the CSE department at RUET, software and web developer, and Rabindra Sangeet artist.')
@section('content')
<section class="hero-section">
    <div class="container hero-layout">
        <div class="hero-copy">
            <p class="eyebrow hero-eyebrow"><span class="status-dot"></span>Senior Technical Officer <span class="eyebrow-divider">/</span> RUET CSE</p>
            <h1>Web developer.<br><span>IT professional.</span></h1>
            <p class="hero-description">{{ $profile?->intro_en ?? 'I’m Sakib Nihal Arnab. I work in the CSE department at RUET and build practical web applications and websites.' }}</p>
            <div class="hero-actions">
                <a class="button hero-button" href="#projects">Explore my work <span aria-hidden="true">↗</span></a>
                <a class="hero-secondary-link" href="{{ route('contact') }}">Get in touch <span aria-hidden="true">→</span></a>
            </div>
            <div class="hero-social-links" aria-label="Social profiles">
                @foreach($socialLinks->take(4) as $link)
                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">{{ $link->label ?: $link->platform }} <span aria-hidden="true">↗</span></a>
                @endforeach
            </div>
        </div>
        <figure class="hero-portrait">
            <img src="{{ $profileImageUrl }}" alt="{{ $profile?->name ?? config('site.name') }}" fetchpriority="high">
            <figcaption><span class="portrait-caption-mark">SA</span><span><strong>{{ $profile?->name ?? config('site.name') }}</strong><small>Rajshahi, Bangladesh</small></span></figcaption>
            <span class="portrait-index">01 <span>/</span> RUET · CSE</span>
        </figure>
    </div>
</section>

<section class="credentials-bar" aria-label="Professional overview">
    <div class="container credentials-grid">
        <div><span>01</span><strong>RUET CSE</strong><small>Institutional IT</small></div>
        <div><span>02</span><strong>Web development</strong><small>Laravel · PHP · WordPress</small></div>
        <div><span>03</span><strong>Based in Rajshahi</strong><small>Bangladesh</small></div>
        <a href="#experience">Explore my background <span aria-hidden="true">↘</span></a>
    </div>
</section>

<section class="section-block intro-section" id="about">
    <div class="container two-column-section">
        <div class="section-label"><span>01</span><span>About</span></div>
        <div class="intro-content">
            <h2>Technology should make<br><span>everyday work better.</span></h2>
            <div class="intro-description">
                <p>{{ $profile?->about_en ?? 'I work in institutional technology at the Department of CSE, Rajshahi University of Engineering & Technology. I also build useful web applications and websites.' }}</p>
                <a class="text-link" href="{{ route('about') }}">More about me <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </div>
</section>

<section class="section-block skills-section" id="expertise">
    <div class="container">
        <div class="section-heading-row">
            <div><div class="section-label"><span>02</span><span>Expertise</span></div><h2>Practical skills.<br><span>Thoughtful solutions.</span></h2></div>
            <p>Tools and areas of work reflected in my professional experience and projects.</p>
        </div>
        <div class="skills-grid">
            @forelse($skills as $category)
                <article class="skill-card">
                    <span class="skill-index">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $category->name_en }}</h3>
                    <div class="skill-tags">@foreach($category->skills as $skill)<span>{{ $skill->name }}</span>@endforeach</div>
                </article>
            @empty
                <p>Professional skills will be added soon.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="section-block projects-section" id="projects">
    <div class="container">
        <div class="section-heading-row">
            <div><div class="section-label"><span>03</span><span>Selected work</span></div><h2>Built around<br><span>real-world needs.</span></h2></div>
            <p>A selection of software and web work, including a system developed for RUET’s CSE department.</p>
        </div>
        @if($featuredProject)
            <article class="featured-project">
                <a class="project-art" href="{{ route('projects.show', $featuredProject->slug) }}" aria-label="View {{ $featuredProject->title_en }}">
                    @if($featuredProject->cover_path)<img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($featuredProject->cover_path) }}" alt="" loading="lazy">@endif
                    <span class="project-art-kicker">{{ $featuredProject->organization ?: 'Selected project' }}</span>
                    <span class="project-art-title">RUET<br><strong>Inventory</strong></span>
                    <span class="project-art-footer">DEPARTMENTAL SOFTWARE <span>↗</span></span>
                </a>
                <div class="project-copy">
                    <p class="eyebrow">{{ $featuredProject->organization ?: 'Institutional software' }}{{ $featuredProject->development_year ? ' · '.$featuredProject->development_year : '' }}</p>
                    <h3>{{ $featuredProject->title_en }}</h3>
                    <p>{{ $featuredProject->summary_en }}</p>
                    <div class="project-tech">@foreach($featuredProject->technologies as $technology)<span>{{ $technology->name }}</span>@endforeach</div>
                    <div class="project-links">
                        <a href="{{ route('projects.show', $featuredProject->slug) }}">Project details <span aria-hidden="true">↗</span></a>
                        @if($featuredProject->live_url)<a href="{{ $featuredProject->live_url }}" target="_blank" rel="noopener noreferrer">Live system <span aria-hidden="true">↗</span></a>@endif
                        @if($featuredProject->source_url)<a href="{{ $featuredProject->source_url }}" target="_blank" rel="noopener noreferrer">Source code <span aria-hidden="true">↗</span></a>@endif
                    </div>
                </div>
            </article>
        @else
            <p>Selected projects will be added soon.</p>
        @endif
        <div class="section-footer-link"><span>More projects and repositories</span><a href="{{ route('projects.index') }}">Browse all projects <span aria-hidden="true">↗</span></a></div>
    </div>
</section>

<section class="section-block experience-section" id="experience">
    <div class="container">
        <div class="section-label"><span>04</span><span>Experience &amp; education</span></div>
        <div class="experience-grid">
            <div class="timeline-column">
                <h2>Professional experience</h2>
                @forelse($experiences as $experience)
                    <article class="timeline-entry">
                        <span class="timeline-period">{{ $experience->started_at?->format('M Y') }} — {{ $experience->is_current ? 'Present' : $experience->ended_at?->format('M Y') }}</span>
                        <div><h3>{{ $experience->title_en }}</h3><p>{{ $experience->organization_en }}</p>@if($experience->location)<small>{{ $experience->location }}</small>@endif</div>
                    </article>
                @empty
                    <p>Experience details will be added soon.</p>
                @endforelse
                @foreach($freelanceProfiles as $freelance)
                    <article class="timeline-entry"><span class="timeline-period">Freelance</span><div><h3>{{ $freelance->service_en }}</h3><p><a href="{{ $freelance->profile_url }}" target="_blank" rel="noopener noreferrer">{{ $freelance->platform }} ↗</a></p></div></article>
                @endforeach
            </div>
            <div class="timeline-column education-column">
                <h2>Education</h2>
                @forelse($educations as $education)
                    <article class="timeline-entry">
                        <span class="timeline-period">{{ $education->graduated_year }}</span>
                        <div><h3>{{ $education->degree_en }}</h3><p>{{ $education->institution_en }}</p></div>
                    </article>
                @empty
                    <p>Education details will be added soon.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<section class="section-block personal-section">
    <div class="container personal-grid">
        <div class="personal-copy">
            <div class="section-label"><span>05</span><span>Beyond work</span></div>
            <p class="eyebrow">Music &amp; photography</p>
            <h2>A different kind<br>of <span>expression.</span></h2>
            <p>Outside technology, I perform Rabindra Sangeet with Rajshahi Betar and enjoy photography.</p>
            <div class="personal-links"><a href="{{ route('music.index') }}">Music <span aria-hidden="true">↗</span></a><a href="{{ route('photography.index') }}">Photography <span aria-hidden="true">↗</span></a></div>
        </div>
        <a class="personal-photo" href="{{ route('music.index') }}">
            <img src="{{ $featuredMusic?->image_path && ! str_starts_with($featuredMusic->image_path, 'images/') ? \Illuminate\Support\Facades\Storage::disk('public')->url($featuredMusic->image_path) : asset('images/sakib-music.jpg') }}" alt="Sakib Nihal Arnab with a guitar" loading="lazy">
            <span>Rabindra Sangeet · Rajshahi Betar <span aria-hidden="true">↗</span></span>
        </a>
    </div>
</section>

<section class="contact-section" id="contact">
    <div class="container contact-layout">
        <div>
            <div class="section-label"><span>06</span><span>Contact</span></div>
            <p class="eyebrow">Have a project in mind?</p>
            <h2>Let’s make<br><span>something useful.</span></h2>
            <a class="contact-email-link" href="mailto:{{ $contactEmail }}">{{ $contactEmail }} <span aria-hidden="true">↗</span></a>
        </div>
        <div class="contact-details">
            @foreach($settings->only(['institutional_email', 'phone', 'office']) as $key => $setting)
                <a href="{{ $key === 'phone' ? 'tel:'.preg_replace('/[^+0-9]/', '', $setting->value_en) : ($key === 'office' ? route('contact') : 'mailto:'.$setting->value_en) }}"><span>{{ str($key)->replace('_', ' ')->title() }}</span><strong>{{ $setting->value_en }}</strong></a>
            @endforeach
            @foreach($socialLinks->whereIn('platform', ['LinkedIn', 'GitHub'])->take(2) as $link)
                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"><span>{{ $link->platform }}</span><strong>{{ $link->label ?: $link->platform }} ↗</strong></a>
            @endforeach
        </div>
    </div>
</section>
@endsection
