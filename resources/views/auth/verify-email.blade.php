@extends('layouts.auth')
@section('title', 'Verify your email')
@section('form')
<span class="eyebrow">ONE LAST STEP</span><h2>Check your<br>inbox.</h2><p class="muted">A verification link has been sent to <strong>{{ auth()->user()->email }}</strong>. Follow it to open your dashboard.</p><form method="POST" action="{{ route('verification.send') }}" class="stack">@csrf<button class="button full">Resend verification email <span>↗</span></button></form><p class="form-foot">Wrong email? <a href="{{ route('profile.edit') }}">Update your profile</a></p>
@endsection
