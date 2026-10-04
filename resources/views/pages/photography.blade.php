@extends('layouts.app')
@section('title', 'Photography')
@section('description', 'Selected photography and travel photographs by Sakib Nihal Arnab.')
@section('content')
<section class="page-hero">
    <div class="container page-hero-inner">
        <p class="eyebrow">PERSONAL JOURNAL</p>
        <h1>Photography &amp; <span>travel.</span></h1>
        <p class="page-intro">A small visual journal of places, people, and moments.</p>
    </div>
</section>
<section class="container portfolio-list-page">
    <nav class="gallery-filters" aria-label="Photography categories"><a href="{{ route('photography.index') }}" @class(['active' => ! $category])>All photographs</a>@foreach($categories as $item)<a href="{{ route('photography.category', $item->slug) }}" @class(['active' => $category?->is($item)])>{{ $item->name_en }}</a>@endforeach</nav>
    <div class="photo-gallery">
        @forelse($photographs as $photograph)
            <figure><button type="button" class="gallery-image" data-gallery-image="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photograph->image_path) }}" data-gallery-caption="{{ $photograph->title_en ?: $photograph->location }}"><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photograph->image_path) }}" alt="{{ $photograph->title_en ?: $photograph->location ?: config('site.name') }}" loading="lazy"></button><figcaption>{{ $photograph->title_en }} @if($photograph->location)<span>{{ $photograph->location }}</span>@endif</figcaption></figure>
        @empty
            <p>The photography gallery will be added soon.</p>
        @endforelse
    </div>
    {{ $photographs->links() }}
</section>
<dialog class="gallery-dialog" data-gallery-dialog><button type="button" class="gallery-close" aria-label="Close gallery">×</button><img alt="" data-gallery-dialog-image><p data-gallery-dialog-caption></p></dialog>
@endsection
