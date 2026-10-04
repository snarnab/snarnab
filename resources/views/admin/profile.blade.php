@extends('admin.layout')
@section('title', 'Profile & contact · Admin')
@section('admin-content')
<div class="admin-heading"><div><p class="eyebrow">SITE IDENTITY</p><h1>Profile &amp; contact</h1></div></div>
<form class="admin-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}">
    @csrf @method('PUT')
    @foreach(['name' => 'Name', 'title_en' => 'Professional title', 'creative_title_en' => 'Portfolio title', 'location' => 'Location'] as $key => $label)
        <div class="admin-field"><label for="{{ $key }}">{{ $label }}</label><input id="{{ $key }}" name="{{ $key }}" value="{{ old($key, $profile->$key) }}"></div>
    @endforeach
    @foreach(['intro_en' => 'Introduction', 'about_en' => 'About'] as $key => $label)
        <div class="admin-field"><label for="{{ $key }}">{{ $label }}</label><textarea id="{{ $key }}" name="{{ $key }}" rows="4">{{ old($key, $profile->$key) }}</textarea></div>
    @endforeach
    <div class="admin-field"><label for="image_path">Profile photo</label><input id="image_path" type="file" name="image_path" accept="image/*">@if($profile->image_path)<small>Current file: {{ $profile->image_path }}</small>@endif</div>
    <h2>Contact information</h2>
    @foreach(['contact_email' => 'Public email', 'institutional_email' => 'RUET email', 'phone' => 'Phone', 'office' => 'Office location'] as $key => $label)
        <div class="admin-field"><label>{{ $label }}</label><input name="settings[{{ $key }}][en]" value="{{ old('settings.'.$key.'.en', $settings->get($key)?->value_en) }}"></div>
    @endforeach
    <div class="admin-form-actions"><button class="button" type="submit">Save profile</button></div>
</form>
@endsection
