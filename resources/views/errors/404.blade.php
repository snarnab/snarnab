@extends('layouts.app')
@section('title', 'Page not found')
@section('content')
<section class="container section empty-state"><span class="eyebrow">404 / A LITTLE DETOUR</span><h1>This path ends here.<br><em>Your journey doesn’t.</em></h1><p class="muted">The page you’re looking for doesn’t exist or has moved.</p><a class="button" href="{{ route('home') }}">Back to home ↗</a></section>
@endsection
