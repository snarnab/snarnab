@extends('layouts.app')
@php($locale = request()->cookie('portfolio-language') === 'en' ? 'en' : 'bn')
@section('title', $locale === 'bn' ? 'ফটোগ্রাফি' : 'Photography')
@section('description', $locale === 'bn' ? 'সাকিব নিহাল আরনাবের ফটোগ্রাফি ও ভ্রমণের নির্বাচিত ছবি।' : 'Selected photography and travel photographs by Sakib Nihal Arnab.')
@section('content')
<section class="container portfolio-list-page">
    <p class="eyebrow">{{ $locale === 'bn' ? 'ব্যক্তিগত আগ্রহ' : 'PERSONAL INTEREST' }}</p>
    <h1>{{ $locale === 'bn' ? 'ফটোগ্রাফি' : 'Photography' }}</h1>
    <p class="page-intro">{{ $locale === 'bn' ? 'ভ্রমণ ও ফটোগ্রাফির নির্বাচিত মুহূর্ত।' : 'A small visual journal of places and moments.' }}</p>
    <nav class="gallery-filters" aria-label="Photography categories"><a href="{{ route('photography.index') }}" @class(['active' => ! $category])>{{ $locale === 'bn' ? 'সব ছবি' : 'All photographs' }}</a>@foreach($categories as $item)<a href="{{ route('photography.category', $item->slug) }}" @class(['active' => $category?->is($item)])>{{ $item->getAttribute('name_'.$locale) }}</a>@endforeach</nav>
    <div class="photo-gallery">
        @forelse($photographs as $photograph)
            <figure><button type="button" class="gallery-image" data-gallery-image="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photograph->image_path) }}" data-gallery-caption="{{ $photograph->getAttribute('title_'.$locale) ?: $photograph->location }}"><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photograph->image_path) }}" alt="{{ $photograph->getAttribute('title_'.$locale) ?: $photograph->location ?: config('site.name') }}" loading="lazy"></button><figcaption>{{ $photograph->getAttribute('title_'.$locale) }} @if($photograph->location)<span>{{ $photograph->location }}</span>@endif</figcaption></figure>
        @empty
            <p>{{ $locale === 'bn' ? 'ছবির গ্যালারি শিগগিরই যোগ করা হবে।' : 'The photography gallery will be added soon.' }}</p>
        @endforelse
    </div>
    {{ $photographs->links() }}
</section>
<dialog class="gallery-dialog" data-gallery-dialog><button type="button" class="gallery-close" aria-label="Close gallery">×</button><img alt="" data-gallery-dialog-image><p data-gallery-dialog-caption></p></dialog>
@endsection
