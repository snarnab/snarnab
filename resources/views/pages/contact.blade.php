@extends('layouts.app')
@section('title', 'Contact')
@section('description', 'Contact Sakib Nihal Arnab about professional work, technology, or music.')
@section('content')
<section class="container contact-page">
    <header class="music-page-header contact-page-heading">
        <h1>Contact to <span>Arnab</span></h1>
        <span class="music-header-rule" aria-hidden="true"></span>
    </header>
    <div class="contact-heading">
        <p class="eyebrow">DIRECT CONTACT</p>
        <h2>Reach out<br>directly.</h2>
        <div class="contact-direct">
            @foreach($settings as $key => $setting)
                <a href="{{ $key === 'phone' ? 'tel:'.preg_replace('/[^+0-9]/', '', $setting->value_en) : ($key === 'office' ? route('contact') : 'mailto:'.$setting->value_en) }}"><span>{{ str($key)->replace('_', ' ')->title() }}</span><strong>{{ $setting->value_en }}</strong></a>
            @endforeach
        </div>
        <nav class="info-socials contact-shortcuts" aria-label="Direct contact shortcuts">
            @foreach($socialLinks->whereIn('platform', ['LinkedIn', 'GitHub', 'Facebook', 'YouTube']) as $link)
                <a href="{{ $link->url }}" aria-label="{{ $link->platform }}" title="{{ $link->platform }}" target="_blank" rel="noopener noreferrer"><span class="contact-shortcut-icon">@include('partials.contact-icon', ['type' => strtolower($link->platform)])</span><span>{{ $link->platform }}</span></a>
            @endforeach
            @if($settings->has('phone'))
                @php($phoneNumber = preg_replace('/[^+0-9]/', '', $settings['phone']->value_en))
                @php($whatsappNumber = preg_replace('/[^0-9]/', '', $settings['phone']->value_en))
                <a href="tel:{{ $phoneNumber }}" aria-label="Call Sakib Nihal Arnab" title="Call"><span class="contact-shortcut-icon">@include('partials.contact-icon', ['type' => 'phone'])</span><span>Call</span></a>
                <a href="https://wa.me/{{ $whatsappNumber }}" aria-label="WhatsApp Sakib Nihal Arnab" title="WhatsApp" target="_blank" rel="noopener noreferrer"><span class="contact-shortcut-icon">@include('partials.contact-icon', ['type' => 'whatsapp'])</span><span>WhatsApp</span></a>
            @endif
            @foreach(['contact_email' => 'Personal email', 'institutional_email' => 'RUET email'] as $key => $label)
                @if($settings->has($key))
                    <a href="mailto:{{ $settings[$key]->value_en }}" aria-label="{{ $label }}" title="{{ $label }}"><span class="contact-shortcut-icon">@include('partials.contact-icon', ['type' => 'email'])</span><span>{{ $label }}</span></a>
                @endif
            @endforeach
        </nav>
    </div>
    <div class="contact-form-card">
        <p class="eyebrow">SEND A MESSAGE</p>
        <h2>Contact Sakib Nihal Arnab.</h2>
        <p>Share the project details to request a response from Sakib Nihal Arnab.</p>
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
