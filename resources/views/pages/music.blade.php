@extends('layouts.app')
@section('title', 'Music')
@section('description', 'Music and Rabindra Sangeet performances by Sakib Nihal Arnab.')
@section('content')
<section class="page-hero">
    <div class="container page-hero-inner">
        <p class="eyebrow">OUTSIDE OF WORK</p>
        <h1>Music &amp; <span>performance.</span></h1>
        <p class="page-intro">A personal space for my musical practice as a Rabindra Sangeet artist with Rajshahi Betar.</p>
    </div>
</section>
<section class="container portfolio-list-page">
    <div class="music-list">
        @forelse($musicItems as $item)
            <article class="music-list-card">
                @if($item->image_path)<img src="{{ str_starts_with($item->image_path, 'images/') ? asset($item->image_path) : \Illuminate\Support\Facades\Storage::disk('public')->url($item->image_path) }}" alt="{{ $item->title_en }}" loading="lazy">@endif
                <div><p class="eyebrow">RAJSHAHI BETAR</p><h2>{{ $item->title_en }}</h2><p>{{ $item->description_en }}</p>@if($item->youtube_url)<a class="text-link" href="{{ $item->youtube_url }}" target="_blank" rel="noopener noreferrer">Visit YouTube <span aria-hidden="true">↗</span></a>@endif @if($item->facebook_url)<a class="text-link" href="{{ $item->facebook_url }}" target="_blank" rel="noopener noreferrer">Facebook <span aria-hidden="true">↗</span></a>@endif</div>
            </article>
        @empty
            <p>Music updates will be added soon.</p>
        @endforelse
    </div>
    {{ $musicItems->links() }}
</section>
@endsection
