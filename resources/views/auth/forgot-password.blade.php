@extends('layouts.auth')
@section('title', 'Forgot password')
@section('form')
<span class="eyebrow">A FRESH START</span><h2>Forgot your<br>password?</h2><p class="muted">Enter your email and a password reset link will be sent.</p>
<form method="POST" action="{{ route('password.email') }}" class="stack">@csrf<x-field name="email" label="Email address" type="email" autocomplete="email" required autofocus /><button class="button full">Send reset link <span>↗</span></button></form><p class="form-foot"><a href="{{ route('login') }}">← Back to log in</a></p>
@endsection
