@extends('layouts.app')
@section('title', 'Projects')
@section('description', 'Selected web and software projects by Sakib Nihal Arnab.')
@section('content')
<section class="container portfolio-list-page">
    <header class="music-page-header">
        <h1>Arnab’s <em>Projects</em></h1>
        <span class="music-header-rule" aria-hidden="true"></span>
    </header>
    <div class="project-list-grid">
        @forelse($projects as $project)
            <article class="project-list-card">
                @if($project->cover_path)<img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($project->cover_path) }}" alt="{{ $project->title_en }}" loading="lazy">@else<div class="project-list-art"><span>{{ strtoupper($project->category) }}</span><strong>{{ $project->organization ?: config('site.name') }}</strong></div>@endif
                <div class="project-list-content"><p class="eyebrow">{{ $project->organization ?: strtoupper($project->category) }}</p><h2><a href="{{ route('projects.show', $project->slug) }}">{{ $project->title_en }}</a></h2><p>{{ $project->summary_en }}</p><div class="project-tech">@foreach($project->technologies as $technology)<span>{{ $technology->name }}</span>@endforeach</div><a class="text-link" href="{{ route('projects.show', $project->slug) }}">View project <span aria-hidden="true">↗</span></a></div>
            </article>
        @empty
            <p>Projects will be added soon.</p>
        @endforelse
    </div>
    {{ $projects->links() }}
</section>
@endsection
