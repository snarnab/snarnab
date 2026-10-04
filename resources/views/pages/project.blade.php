@extends('layouts.app')
@section('title', $project->title_en)
@section('description', $project->summary_en)
@section('content')
<article class="container project-detail-page">
    <a class="text-link" href="{{ route('projects.index') }}">← All projects</a>
    <p class="eyebrow">{{ $project->organization ?: strtoupper($project->category) }}{{ $project->development_year ? ' · '.$project->development_year : '' }}</p>
    <h1>{{ $project->title_en }}</h1>
    <p class="page-intro">{{ $project->summary_en }}</p>
    <div class="project-tech">@foreach($project->technologies as $technology)<span>{{ $technology->name }}</span>@endforeach</div>
    @if($project->cover_path)<img class="project-detail-cover" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($project->cover_path) }}" alt="{{ $project->title_en }}" loading="lazy">@endif
    <div class="project-detail-actions">@if($project->live_url)<a class="button" href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer">Visit live system ↗</a>@endif @if($project->source_url)<a class="button secondary" href="{{ $project->source_url }}" target="_blank" rel="noopener noreferrer">View source code ↗</a>@endif</div>
    <div class="project-case-study">
        @foreach(['problem' => 'The need', 'solution' => 'The solution', 'outcome' => 'The outcome'] as $key => $label)
            @if($project->getAttribute($key.'_en'))<section><h2>{{ $label }}</h2><p>{{ $project->getAttribute($key.'_en') }}</p></section>@endif
        @endforeach
    </div>
    @if($project->images->isNotEmpty())<div class="photo-gallery">@foreach($project->images as $image)<figure><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image->image_path) }}" alt="{{ $image->alt_en ?: $project->title_en }}" loading="lazy"></figure>@endforeach</div>@endif
</article>
@endsection
