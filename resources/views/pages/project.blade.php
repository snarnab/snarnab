@extends('layouts.app')
@php($locale = request()->cookie('portfolio-language') === 'en' ? 'en' : 'bn')
@section('title', $project->getAttribute('title_'.$locale))
@section('description', $project->getAttribute('summary_'.$locale))
@section('content')
<article class="container project-detail-page">
    <a class="text-link" href="{{ route('projects.index') }}">← {{ $locale === 'bn' ? 'সব প্রকল্প' : 'All projects' }}</a>
    <p class="eyebrow">{{ $project->organization ?: strtoupper($project->category) }}{{ $project->development_year ? ' · '.$project->development_year : '' }}</p>
    <h1>{{ $project->getAttribute('title_'.$locale) }}</h1>
    <p class="page-intro">{{ $project->getAttribute('summary_'.$locale) }}</p>
    <div class="project-tech">@foreach($project->technologies as $technology)<span>{{ $technology->name }}</span>@endforeach</div>
    @if($project->cover_path)<img class="project-detail-cover" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($project->cover_path) }}" alt="{{ $project->getAttribute('title_'.$locale) }}" loading="lazy">@endif
    <div class="project-detail-actions">@if($project->live_url)<a class="button" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer">{{ $locale === 'bn' ? 'লাইভ সাইট দেখুন' : 'Visit live site' }} ↗</a>@endif @if($project->source_url)<a class="button secondary" href="{{ $project->source_url }}" target="_blank" rel="noopener noreferrer">{{ $locale === 'bn' ? 'সোর্স কোড' : 'Source code' }} ↗</a>@endif</div>
    <div class="project-case-study">
        @foreach(['problem' => $locale === 'bn' ? 'প্রয়োজন' : 'The need', 'solution' => $locale === 'bn' ? 'সমাধান' : 'The solution', 'outcome' => $locale === 'bn' ? 'ফলাফল' : 'Outcome'] as $key => $label)
            @if($project->getAttribute($key.'_'.$locale))<section><h2>{{ $label }}</h2><p>{{ $project->getAttribute($key.'_'.$locale) }}</p></section>@endif
        @endforeach
    </div>
    @if($project->images->isNotEmpty())<div class="photo-gallery">@foreach($project->images as $image)<figure><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image->image_path) }}" alt="{{ $image->getAttribute('alt_'.$locale) ?: $project->getAttribute('title_'.$locale) }}" loading="lazy"></figure>@endforeach</div>@endif
</article>
@endsection
