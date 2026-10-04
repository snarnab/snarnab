@extends('layouts.app')
@php($locale = request()->cookie('portfolio-language') === 'en' ? 'en' : 'bn')
@section('title', $locale === 'bn' ? 'প্রকল্প' : 'Projects')
@section('description', $locale === 'bn' ? 'সাকিব নিহাল আরনাবের নির্বাচিত ওয়েব ও সফটওয়্যার প্রকল্প।' : 'Selected web and software projects by Sakib Nihal Arnab.')
@section('content')
<section class="container portfolio-list-page">
    <p class="eyebrow">{{ $locale === 'bn' ? 'নির্বাচিত কাজ' : 'SELECTED WORK' }}</p>
    <h1>{{ $locale === 'bn' ? 'প্রকল্পসমূহ' : 'Projects' }}</h1>
    <p class="page-intro">{{ $locale === 'bn' ? 'বাস্তব প্রয়োজন অনুযায়ী তৈরি ওয়েব অ্যাপ্লিকেশন এবং সফটওয়্যার।' : 'Web applications and software built around real needs.' }}</p>
    <div class="project-list-grid">
        @forelse($projects as $project)
            <article class="project-list-card">
                @if($project->cover_path)<img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($project->cover_path) }}" alt="{{ $project->getAttribute('title_'.$locale) }}" loading="lazy">@else<div class="project-list-art"><span>{{ strtoupper($project->category) }}</span><strong>{{ $project->organization ?: config('site.name') }}</strong></div>@endif
                <div class="project-list-content"><p class="eyebrow">{{ $project->organization ?: strtoupper($project->category) }}</p><h2><a href="{{ route('projects.show', $project->slug) }}">{{ $project->getAttribute('title_'.$locale) }}</a></h2><p>{{ $project->getAttribute('summary_'.$locale) }}</p><div class="project-tech">@foreach($project->technologies as $technology)<span>{{ $technology->name }}</span>@endforeach</div><a class="text-link" href="{{ route('projects.show', $project->slug) }}">{{ $locale === 'bn' ? 'বিস্তারিত' : 'View project' }} ↗</a></div>
            </article>
        @empty
            <p>{{ $locale === 'bn' ? 'প্রকল্প শিগগিরই যোগ করা হবে।' : 'Projects will be added soon.' }}</p>
        @endforelse
    </div>
    {{ $projects->links() }}
</section>
@endsection
