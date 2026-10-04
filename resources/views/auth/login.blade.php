@extends('layouts.auth')
@section('title', 'Log in')
@section('form')
<span class="eyebrow">WELCOME BACK</span><h2>Make yourself<br>at home.</h2><p class="muted">Log in to your {{ config('site.name') }} account.</p>
<form method="POST" action="{{ route('login') }}" class="stack">@csrf
    <x-field name="email" label="Email address" type="email" autocomplete="username" required autofocus />
    <x-field name="password" label="Password" type="password" autocomplete="current-password" required />
    <div class="form-row"><label class="checkbox"><input type="checkbox" name="remember" value="1" @checked(old('remember'))> Remember me</label><a href="{{ route('password.request') }}">Forgot password?</a></div>
    <button class="button full">Log in <span>↗</span></button>
</form><p class="form-foot">New around here? <a href="{{ route('register') }}">Create an account</a></p>
@endsection
