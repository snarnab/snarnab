@extends('layouts.app')
@section('title', 'Contact')
@section('description', 'Contact Sakib Nihal Arnab about professional work, technology, or music.')
@section('content')
<section class="page-hero">
    <div class="container page-hero-inner">
        <p class="eyebrow">CONTACT</p>
        <h1>Let’s start<br><span>a conversation.</span></h1>
        <p class="page-intro">For project enquiries, technical conversations, or music-related requests, send me a message.</p>
    </div>
</section>
<section class="container contact-page">
    <div class="contact-heading">
        <p class="eyebrow">DIRECT CONTACT</p>
        <h2>Reach out<br>directly.</h2>
        <div class="contact-direct">
            @foreach($settings as $key => $setting)
                <a href="{{ $key === 'phone' ? 'tel:'.preg_replace('/[^+0-9]/', '', $setting->value_en) : ($key === 'office' ? route('contact') : 'mailto:'.$setting->value_en) }}"><span>{{ str($key)->replace('_', ' ')->title() }}</span><strong>{{ $setting->value_en }}</strong></a>
            @endforeach
        </div>
        <div class="info-socials">@foreach($socialLinks as $link)<a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">{{ $link->label ?: $link->platform }} ↗</a>@endforeach</div>
    </div>
    <div class="contact-form-card">
        <p class="eyebrow">SEND A MESSAGE</p>
        <h2>I’m listening.</h2>
        <p>Share a few details and I’ll get back to you.</p>
        <form method="POST" action="{{ route('contact.store') }}" class="stack">
            @csrf
            <x-field name="name" label="Your name" type="text" :value="auth()->user()?->name" autocomplete="name" required maxlength="100" />
            <x-field name="email" label="Email address" type="email" :value="auth()->user()?->email" autocomplete="email" required maxlength="255" />
            <x-field name="subject" label="Subject" type="text" required maxlength="150" />
            <div class="field"><label for="inquiry_type">What is this about?</label><select id="inquiry_type" name="inquiry_type" required><option value="professional">Professional work</option><option value="technical">Technical discussion</option><option value="music">Music</option><option value="general">General enquiry</option></select></div>
            <div class="field"><label for="message">Your message</label><textarea id="message" name="message" rows="5" minlength="10" maxlength="5000" required>{{ old('message') }}</textarea></div>
            <div class="contact-honeypot" aria-hidden="true"><label for="website">Leave this field empty</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
            <button class="button full" type="submit">Send message <span aria-hidden="true">↗</span></button>
        </form>
    </div>
</section>
@endsection
