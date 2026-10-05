@extends('layouts.app')
@section('title', 'About')
@section('description', $profile?->about_en ?? config('site.description'))
@section('content')
<section class="container about-page-grid">
    <header class="music-page-header about-page-heading">
        <h1>About <span>Arnab</span></h1>
        <span class="music-header-rule" aria-hidden="true"></span>
    </header>
    <div class="about-page-portrait">
        <img src="{{ asset('images/about-portrait.jpg') }}" alt="{{ $profile?->name ?? config('site.name') }}" loading="lazy">
        <p>{{ $profile?->name ?? config('site.name') }}<span>Rajshahi, Bangladesh</span></p>
    </div>
    <div class="about-page-content">
        <p class="about-biography">{{ $profile?->about_en ?? config('site.description') }} With a strong foundation in computer science, he develops practical web applications and websites using Laravel, PHP, and WordPress. His experience includes institutional software, real-world digital solutions, and freelance web development. Beyond technology, Sakib performs Rabindra Sangeet with Rajshahi Betar and pursues photography. These creative interests bring a thoughtful eye for detail and a broader perspective to his work.</p>
        <div class="info-facts">
            @foreach($settings as $key => $setting)
                <a href="{{ $key === 'phone' ? 'tel:'.preg_replace('/[^+0-9]/', '', $setting->value_en) : ($key === 'office' ? route('contact') : 'mailto:'.$setting->value_en) }}"><span>{{ str($key)->replace('_', ' ')->title() }}</span><strong>{{ $setting->value_en }}</strong></a>
            @endforeach
        </div>
        <div class="info-socials">@foreach($socialLinks as $link)<a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">{{ $link->label ?: $link->platform }} ↗</a>@endforeach</div>
        <section class="about-education">
            <h2>Education</h2>
            @foreach($educations as $education)
                <article><span>{{ $education->graduated_year }}</span><div><strong>{{ $education->degree_en }}</strong><p>{{ $education->institution_en }}</p></div></article>
            @endforeach
        </section>
        <section class="about-education">
            <h2>Experience</h2>
            @foreach($experiences as $experience)
                <article class="experience-detail-entry"><span>{{ $experience->started_at?->format('F j, Y') ?? ($experience->is_current ? 'Current' : 'Freelance') }}{{ $experience->started_at && ($experience->is_current || $experience->ended_at) ? ' — '.($experience->is_current ? 'Present' : $experience->ended_at->format('F Y')) : '' }}</span><div><strong>{{ $experience->title_en }}</strong><p>{{ $experience->organization_en }}</p>@if($experience->details_en)<p>{{ $experience->details_en }}</p>@endif</div></article>
            @endforeach
        </section>
        <section class="about-awards" aria-labelledby="awards-heading">
            <header class="awards-heading">
                <p class="eyebrow">RECOGNITION &amp; ACHIEVEMENTS</p>
                <h2 id="awards-heading">Qualifications &amp; awards</h2>
                <p>Academic milestones and recognition for leadership at BAUET.</p>
            </header>
            <div class="awards-grid">
                <article class="award-card">
                    <div class="award-meta"><span class="award-category">Leadership</span><span>2019</span></div>
                    <h3>Welfare Club</h3>
                    <p class="award-role">General Secretary · Certificate of Recognition</p>
                    <p class="award-institution">Bangladesh Army University of Engineering &amp; Technology</p>
                </article>
                <article class="award-card">
                    <div class="award-meta"><span class="award-category">Leadership</span><span>2019</span></div>
                    <h3>Cultural Club</h3>
                    <p class="award-role">General Secretary · Certificate of Recognition</p>
                    <p class="award-institution">Bangladesh Army University of Engineering &amp; Technology</p>
                </article>
                <article class="award-card">
                    <div class="award-meta"><span class="award-category">Leadership</span><span>2019</span></div>
                    <h3>Photography &amp; Media Club</h3>
                    <p class="award-role">General Secretary · Certificate of Recognition</p>
                    <p class="award-institution">Bangladesh Army University of Engineering &amp; Technology</p>
                </article>
                <article class="award-card">
                    <div class="award-meta"><span class="award-category">Scholarship</span><span>2014</span></div>
                    <h3>H.S.C. Scholarship</h3>
                    <p class="award-role">General quota · Higher Secondary Certificate, Class 12</p>
                    <p class="award-institution">Rajshahi Board</p>
                </article>
                <article class="award-card">
                    <div class="award-meta"><span class="award-category">Scholarship</span><span>2008</span></div>
                    <h3>Junior School Scholarship</h3>
                    <p class="award-role">General quota · Junior School, Class 8</p>
                    <p class="award-institution">Rajshahi Board</p>
                </article>
            </div>
        </section>
<section class="technical-skills-section" id="skills" aria-labelledby="technical-skills-heading">
    <header class="technical-skills-header">
        <p class="eyebrow">TECHNICAL &amp; PROFESSIONAL EXPERTISE</p>
        <h2 id="technical-skills-heading">A broad foundation.<br><span>Practical expertise.</span></h2>
        <p>Sakib Nihal Arnab’s skills span software development, infrastructure, technical support and creative tools.</p>
    </header>
    <div class="technical-skills-grid">
        @foreach($skills as $category)
            <article class="technical-skill-card">
                <header><span class="technical-skill-number">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><span class="technical-skill-count">{{ $category->skills->count() }} skills</span></header>
                <h3>{{ $category->name_en }}</h3>
                <ul class="technical-skill-tags">@foreach($category->skills as $skill)<li>{{ $skill->name }}</li>@endforeach</ul>
            </article>
        @endforeach
    </div>
</section>
    </div>
</section>
@endsection
