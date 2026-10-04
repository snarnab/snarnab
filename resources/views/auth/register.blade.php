@extends('layouts.auth')
@section('title', 'Create an account')
@section('form')
<span class="eyebrow">LET’S BEGIN</span><h2>Your next chapter<br>starts here.</h2><p class="muted">Create your free account.</p>
<form method="POST" action="{{ route('register') }}" class="stack">@csrf
    <x-field name="name" label="Full name" autocomplete="name" required maxlength="100" autofocus />
    <x-field name="email" label="Email address" type="email" autocomplete="username" required maxlength="255" />
    <x-field name="password" label="Password" type="password" autocomplete="new-password" required minlength="8" />
    <small class="muted">Use at least 8 characters, including a letter and a number.</small>
    <x-field name="password_confirmation" label="Confirm password" type="password" autocomplete="new-password" required />
    <label class="checkbox"><input type="checkbox" name="terms" value="1" required @checked(old('terms'))><span>I agree to the <a href="{{ route('terms') }}">Terms</a> and <a href="{{ route('privacy') }}">Privacy policy</a>.</span></label>
    <button class="button full">Create account <span>↗</span></button>
</form><p class="form-foot">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
@endsection
