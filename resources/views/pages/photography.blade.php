@extends('layouts.app')
@section('title', 'Photography')
@section('description', 'Selected photography and travel photographs by Sakib Nihal Arnab.')
@section('content')
<section class="container portfolio-list-page">
    <header class="music-page-header photography-page-heading">
        <h1>Arnab’s <span>Photography</span></h1>
        <span class="music-header-rule" aria-hidden="true"></span>
    </header>
    <nav class="gallery-filters" aria-label="Photography categories"><a href="{{ route('photography.index') }}" @class(['active' => ! $category])>All photographs</a>@foreach($categories as $item)<a href="{{ route('photography.category', $item->slug) }}" @class(['active' => $category?->is($item)])>{{ $item->name_en }}</a>@endforeach</nav>
    <div class="photo-gallery">
        @forelse($photographs as $photograph)
            <figure><button type="button" class="gallery-image" data-gallery-image="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photograph->image_path) }}" data-gallery-caption="{{ $photograph->title_en ?: $photograph->location }}"><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($photograph->image_path) }}" alt="{{ $photograph->title_en ?: $photograph->location ?: config('site.name') }}" loading="lazy"></button><figcaption>{{ $photograph->title_en }} @if($photograph->location)<span>{{ $photograph->location }}</span>@endif</figcaption></figure>
        @empty
            <p>The photography gallery will be added soon.</p>
        @endforelse
    </div>
    <nav class="gallery-pagination" aria-label="Photography pages">
        @if($photographs->previousPageUrl())
            <a class="gallery-page-button" href="{{ $photographs->previousPageUrl() }}" rel="prev" aria-label="Previous page">← <span>Previous</span></a>
        @else
            <span class="gallery-page-button is-disabled" aria-disabled="true">← <span>Previous</span></span>
        @endif
        <span class="gallery-page-status">Page <strong>{{ $photographs->currentPage() }}</strong> of <strong>{{ $photographs->lastPage() }}</strong></span>
        @if($photographs->nextPageUrl())
            <a class="gallery-page-button" href="{{ $photographs->nextPageUrl() }}" rel="next" aria-label="Next page"><span>Next</span> →</a>
        @else
            <span class="gallery-page-button is-disabled" aria-disabled="true"><span>Next</span> →</span>
        @endif
    </nav>
</section>
<dialog class="gallery-dialog" data-gallery-dialog><button type="button" class="gallery-close" aria-label="Close gallery">×</button><img alt="" data-gallery-dialog-image><p data-gallery-dialog-caption></p></dialog>
@endsection
