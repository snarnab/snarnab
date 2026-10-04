@extends('layouts.app')
@php($locale = request()->cookie('portfolio-language') === 'en' ? 'en' : 'bn')
@section('title', $locale === 'bn' ? 'সংগীত' : 'Music')
@section('description', $locale === 'bn' ? 'রাজশাহী বেতারের রবীন্দ্রসংগীত শিল্পী হিসেবে সাকিব নিহাল আরনাবের সংগীতচর্চা।' : 'Music and Rabindra Sangeet performances by Sakib Nihal Arnab.')
@section('content')
<section class="container portfolio-list-page">
    <p class="eyebrow">{{ $locale === 'bn' ? 'কাজের বাইরে' : 'OUTSIDE OF WORK' }}</p>
    <h1>{{ $locale === 'bn' ? 'সংগীত' : 'Music' }}</h1>
    <p class="page-intro">{{ $locale === 'bn' ? 'রাজশাহী বেতারের রবীন্দ্রসংগীত শিল্পী হিসেবে আমার সংগীতচর্চার কিছু নির্বাচিত পরিচিতি।' : 'A separate space for my musical practice as a Rabindra Sangeet artist with Rajshahi Betar.' }}</p>
    <div class="music-list">
        @forelse($musicItems as $item)
            <article class="music-list-card">
                @if($item->image_path)<img src="{{ str_starts_with($item->image_path, 'images/') ? asset($item->image_path) : \Illuminate\Support\Facades\Storage::disk('public')->url($item->image_path) }}" alt="{{ $item->getAttribute('title_'.$locale) }}" loading="lazy">@endif
                <div><p class="eyebrow">{{ $locale === 'bn' ? 'রাজশাহী বেতার' : 'RAJSHAHI BETAR' }}</p><h2>{{ $item->getAttribute('title_'.$locale) }}</h2><p>{{ $item->getAttribute('description_'.$locale) }}</p>@if($item->youtube_url)<a class="text-link" href="{{ $item->youtube_url }}" target="_blank" rel="noopener noreferrer">{{ $locale === 'bn' ? 'YouTube-এ দেখুন' : 'Visit YouTube' }} ↗</a>@endif @if($item->facebook_url)<a class="text-link" href="{{ $item->facebook_url }}" target="_blank" rel="noopener noreferrer">Facebook ↗</a>@endif</div>
            </article>
        @empty
            <p>{{ $locale === 'bn' ? 'সংগীতের তথ্য শিগগিরই যোগ করা হবে।' : 'Music updates will be added soon.' }}</p>
        @endforelse
    </div>
    {{ $musicItems->links() }}
</section>
@endsection
