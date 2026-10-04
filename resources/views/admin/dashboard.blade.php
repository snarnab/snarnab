@extends('admin.layout')
@section('title', 'Portfolio admin')
@section('admin-content')
<div class="admin-heading"><div><p class="eyebrow">CONTENT MANAGEMENT</p><h1>Portfolio overview</h1></div><a class="button" href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">View website ↗</a></div>
<div class="admin-stats"><a href="{{ route('admin.messages.index') }}"><span>Unread messages</span><strong>{{ $unreadMessages }}</strong></a>@foreach($resources as $key => $resource)<a href="{{ route('admin.resources.index', $key) }}"><span>{{ $resource['title'] }}</span><strong>{{ $counts[$key] }}</strong></a>@endforeach</div>
<p class="admin-note">Only verified administrator accounts can edit published content. Grant access to a verified account with <code>php artisan portfolio:admin grant email@example.com</code>.</p>
@endsection
