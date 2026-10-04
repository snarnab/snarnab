@extends('layouts.app')
@php($locale = request()->cookie('portfolio-language') === 'en' ? 'en' : 'bn')
@section('title', $locale === 'bn' ? 'পরিচিতি' : 'About')
@section('description', $profile?->getAttribute('about_'.$locale) ?? config('site.description'))
@section('content')
<section class="container info-page">
    <div class="info-heading">
        <p class="eyebrow">ABOUT / পরিচিতি</p>
        <h1>{{ $profile?->name ?? config('site.name') }}</h1>
        <p>{{ $profile?->getAttribute('title_'.$locale) ?? 'Senior Technical Officer · Department of CSE, RUET' }}</p>
        @if($profile?->image_path)
            <div class="about-profile-photo"><img src="{{ str_starts_with($profile->image_path, 'images/') ? asset($profile->image_path) : \Illuminate\Support\Facades\Storage::disk('public')->url($profile->image_path) }}" alt="{{ $profile->name }}" loading="lazy"></div>
        @endif
    </div>
    <div class="info-body">
        <p>{{ $profile?->getAttribute('about_'.$locale) ?? config('site.description') }}</p>
        <div class="info-facts">
            @foreach($settings as $key => $setting)
                <a href="{{ $key === 'phone' ? 'tel:'.preg_replace('/[^+0-9]/', '', $setting->value_en) : ($key === 'office' ? route('contact') : 'mailto:'.$setting->value_en) }}"><span>{{ strtoupper(str_replace('_', ' ', $key)) }}</span><strong>{{ $setting->getAttribute('value_'.$locale) }}</strong></a>
            @endforeach
        </div>
        <div class="info-socials">@foreach($socialLinks as $link)<a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">{{ $link->label ?: $link->platform }} ↗</a>@endforeach</div>
        <section class="about-education">
            <p class="eyebrow">{{ $locale === 'bn' ? 'শিক্ষা' : 'EDUCATION' }}</p>
            @foreach($educations as $education)
                <article><span>{{ $education->started_year ? $education->started_year.' — ' : '' }}{{ $education->graduated_year }}</span><div><strong>{{ $education->getAttribute('degree_'.$locale) }}</strong><p>{{ $education->getAttribute('institution_'.$locale) }}</p></div></article>
            @endforeach
        </section>
        <section class="about-education">
            <p class="eyebrow">{{ $locale === 'bn' ? 'অভিজ্ঞতা' : 'EXPERIENCE' }}</p>
            @foreach($experiences as $experience)
                <article><span>{{ $experience->started_at?->format('Y') }}{{ $experience->is_current ? ' — '.($locale === 'bn' ? 'বর্তমান' : 'Present') : ($experience->ended_at ? ' — '.$experience->ended_at->format('Y') : '') }}</span><div><strong>{{ $experience->getAttribute('title_'.$locale) }}</strong><p>{{ $experience->getAttribute('organization_'.$locale) }}</p></div></article>
            @endforeach
        </section>
    </div>
</section>
@endsection
