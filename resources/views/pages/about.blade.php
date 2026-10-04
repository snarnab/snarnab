@extends('layouts.app')
@section('title', 'About')
@section('description', $profile?->about_en ?? config('site.description'))
@section('content')
<section class="page-hero">
    <div class="container page-hero-inner">
        <p class="eyebrow">ABOUT</p>
        <h1>A little about<br><span>what I do.</span></h1>
        <p class="page-intro">Technology, institutional work, and the people and interests that shape my perspective.</p>
    </div>
</section>
<section class="container about-page-grid">
    <div class="about-page-portrait">
        @if($profile?->image_path)
            <img src="{{ str_starts_with($profile->image_path, 'images/') ? asset($profile->image_path) : \Illuminate\Support\Facades\Storage::disk('public')->url($profile->image_path) }}" alt="{{ $profile->name }}" loading="lazy">
        @endif
        <p>{{ $profile?->name ?? config('site.name') }}<span>Rajshahi, Bangladesh</span></p>
    </div>
    <div class="about-page-content">
        <p class="about-lead">{{ $profile?->about_en ?? config('site.description') }}</p>
        <p>My day-to-day work is grounded in technical service for the Department of CSE at Rajshahi University of Engineering &amp; Technology. I also develop websites and software shaped around practical needs.</p>
        <p>Alongside my technical career, I have worked as a freelance WordPress developer. Music and photography are important parts of my life outside work.</p>
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
                <article><span>{{ $experience->started_at?->format('Y') }}{{ $experience->is_current ? ' — Present' : ($experience->ended_at ? ' — '.$experience->ended_at->format('Y') : '') }}</span><div><strong>{{ $experience->title_en }}</strong><p>{{ $experience->organization_en }}</p></div></article>
            @endforeach
        </section>
    </div>
</section>
@endsection
