@extends('layouts.app')
@section('content')
<section class="container auth-layout">
    <aside class="auth-story"><span class="eyebrow">YOUR NEXT CHAPTER</span><h1>Good things<br>start with<br><em>a connection.</em></h1><p>A space for your ideas, your people, and everything that comes next.</p><div class="story-art" aria-hidden="true"><span>✳</span><span>↗</span><span>✦</span></div><small>{{ config('site.name') }} / A place to begin</small></aside>
    <div class="auth-panel">@yield('form')</div>
</section>
@endsection
