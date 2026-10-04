@extends('layouts.auth')
@section('title', 'Reset password')
@section('form')
<span class="eyebrow">BACK ON TRACK</span><h2>A new password.<br>A fresh start.</h2><p class="muted">Use at least 8 characters, including a letter and a number.</p>
<form method="POST" action="{{ route('password.store') }}" class="stack">@csrf<input type="hidden" name="token" value="{{ $token }}"><x-field name="email" label="Email address" type="email" :value="request('email')" autocomplete="username" required /><x-field name="password" label="New password" type="password" autocomplete="new-password" minlength="8" required /><x-field name="password_confirmation" label="Confirm password" type="password" autocomplete="new-password" required /><button class="button full">Reset password <span>↗</span></button></form>
@endsection
