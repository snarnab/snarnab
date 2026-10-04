@extends('layouts.app')
@section('content')
<section class="admin-shell container">
    <aside class="admin-sidebar">
        <p class="eyebrow">PORTFOLIO ADMIN</p>
        <a href="{{ route('admin.dashboard') }}">Overview</a>
        <a href="{{ route('admin.profile.edit') }}">Profile &amp; contact</a>
        <a href="{{ route('admin.messages.index') }}">Contact messages</a>
        @foreach(config('portfolio.resources') as $key => $resource)
            <a href="{{ route('admin.resources.index', $key) }}">{{ $resource['title'] }}</a>
        @endforeach
        <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">View website ↗</a>
    </aside>
    <div class="admin-content">
        @if(session('status'))<div class="alert success" role="status">{{ session('status') }}</div>@endif
        @if($errors->any())<div class="alert error" role="alert"><strong>Please correct the following:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        @yield('admin-content')
    </div>
</section>
@endsection
