@extends('layouts.app')
@section('title', 'Music')
@section('description', 'Music and Rabindra Sangeet performances by Sakib Nihal Arnab.')
@section('content')
<section class="container portfolio-list-page">
    <header class="music-page-header">
        <span class="music-header-note" aria-hidden="true">♪</span>
        <p>Performances &amp; recordings</p>
        <h1>Arnab’s <em>Music</em></h1>
        <span class="music-header-rule" aria-hidden="true"></span>
    </header>
    <div class="music-thumbnail-grid">
        @forelse($musicItems as $item)
            @php
                $uploadedThumbnail = $item->image_path
                    ? (str_starts_with($item->image_path, 'images/') ? asset($item->image_path) : \Illuminate\Support\Facades\Storage::disk('public')->url($item->image_path))
                    : null;
                $youtubeVideoId = null;
                if ($item->youtube_url) {
                    $youtubeParts = parse_url($item->youtube_url);
                    if (($youtubeParts['host'] ?? '') === 'youtu.be') {
                        $youtubeVideoId = trim($youtubeParts['path'] ?? '', '/');
                    } elseif (str_contains($youtubeParts['host'] ?? '', 'youtube.com')) {
                        parse_str($youtubeParts['query'] ?? '', $youtubeQuery);
                        $youtubeVideoId = $youtubeQuery['v'] ?? null;
                        if (! $youtubeVideoId && preg_match('~/shorts/([^/?]+)~', $youtubeParts['path'] ?? '', $youtubeMatch)) {
                            $youtubeVideoId = $youtubeMatch[1];
                        }
                    }
                }
            @endphp
            <article class="music-thumbnail-card">
                <div class="music-platform-thumbnails">
                    @if($item->youtube_url)
                        <a class="music-platform-thumbnail" href="{{ $item->youtube_url }}" target="_blank" rel="noopener noreferrer" aria-label="Watch {{ $item->title_en }} on YouTube">
                            @if($youtubeVideoId || $uploadedThumbnail)<img src="{{ $youtubeVideoId ? 'https://i.ytimg.com/vi/'.$youtubeVideoId.'/hqdefault.jpg' : $uploadedThumbnail }}" alt="{{ $item->title_en }} on YouTube" loading="lazy">@endif
                            <span class="music-platform-label youtube-label">YouTube</span><span class="music-play" aria-hidden="true">▶</span>
                        </a>
                    @endif
                    @if($item->facebook_url)
                        <a class="music-platform-thumbnail" href="{{ $item->facebook_url }}" target="_blank" rel="noopener noreferrer" aria-label="Watch {{ $item->title_en }} on Facebook">
                            @if($uploadedThumbnail)<img src="{{ $uploadedThumbnail }}" alt="{{ $item->title_en }} on Facebook" loading="lazy">@endif
                            <span class="music-platform-label facebook-label">Facebook</span><span class="music-play" aria-hidden="true">▶</span>
                        </a>
                    @endif
                    @if(! $item->youtube_url && ! $item->facebook_url && $uploadedThumbnail)
                        <div class="music-platform-thumbnail"><img src="{{ $uploadedThumbnail }}" alt="{{ $item->title_en }}" loading="lazy"></div>
                    @endif
                </div>
                <div class="music-thumbnail-content"><h2>{{ $item->title_en }}</h2><p>{{ $item->description_en }}</p></div>
            </article>
        @empty
            <p>Music updates will be added soon.</p>
        @endforelse
    </div>
    {{ $musicItems->links() }}
</section>
@endsection
