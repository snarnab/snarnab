@extends('layouts.app')
@php($locale = request()->cookie('portfolio-language') === 'en' ? 'en' : 'bn')
@section('title', $locale === 'bn' ? 'যোগাযোগ' : 'Contact')
@section('description', $locale === 'bn' ? 'সাকিব নিহাল আরনাবের সঙ্গে যোগাযোগ করুন।' : 'Contact Sakib Nihal Arnab about professional work, technology, or music.')
@section('content')
<section class="container contact-page">
    <div class="contact-heading">
        <p class="eyebrow">{{ $locale === 'bn' ? 'যোগাযোগ' : 'CONTACT' }}</p>
        <h1>{{ $locale === 'bn' ? 'কথা হবে?' : 'Let’s talk.' }}</h1>
        <p>{{ $locale === 'bn' ? 'পেশাগত কাজ, প্রযুক্তি অথবা সংগীত নিয়ে কথা বলতে বার্তা পাঠান।' : 'Send a message about professional work, technology, or music.' }}</p>
        <div class="contact-direct">
            @foreach($settings as $key => $setting)
                <a href="{{ $key === 'phone' ? 'tel:'.preg_replace('/[^+0-9]/', '', $setting->value_en) : ($key === 'office' ? route('contact') : 'mailto:'.$setting->value_en) }}"><span>{{ strtoupper(str_replace('_', ' ', $key)) }}</span><strong>{{ $setting->getAttribute('value_'.$locale) }}</strong></a>
            @endforeach
        </div>
        <div class="info-socials">@foreach($socialLinks as $link)<a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">{{ $link->label ?: $link->platform }} ↗</a>@endforeach</div>
    </div>
    <div class="contact-form-card">
        <p class="eyebrow">{{ $locale === 'bn' ? 'একটি বার্তা পাঠান' : 'SEND A MESSAGE' }}</p>
        <h2>{{ $locale === 'bn' ? 'শুনতে আগ্রহী।' : 'I’m listening.' }}</h2>
        <p>{{ $locale === 'bn' ? 'ফর্মটি পূরণ করুন, আপনার বার্তা সরাসরি আমার কাছে পৌঁছাবে।' : 'Fill out the form below and your message will be delivered directly to me.' }}</p>
        <form method="POST" action="{{ route('contact.store') }}" class="stack">
            @csrf
            <x-field name="name" :label="$locale === 'bn' ? 'আপনার নাম' : 'Your name'" type="text" :value="auth()->user()?->name" autocomplete="name" required maxlength="100" />
            <x-field name="email" :label="$locale === 'bn' ? 'ইমেইল ঠিকানা' : 'Email address'" type="email" :value="auth()->user()?->email" autocomplete="email" required maxlength="255" />
            <x-field name="subject" :label="$locale === 'bn' ? 'বিষয়' : 'Subject'" type="text" required maxlength="150" />
            <div class="field"><label for="inquiry_type">{{ $locale === 'bn' ? 'যোগাযোগের বিষয়' : 'Inquiry type' }}</label><select id="inquiry_type" name="inquiry_type" required><option value="professional">{{ $locale === 'bn' ? 'পেশাগত কাজ' : 'Professional work' }}</option><option value="technical">{{ $locale === 'bn' ? 'প্রযুক্তিগত আলোচনা' : 'Technical discussion' }}</option><option value="music">{{ $locale === 'bn' ? 'সংগীত' : 'Music' }}</option><option value="general">{{ $locale === 'bn' ? 'অন্যান্য' : 'General' }}</option></select></div>
            <div class="field"><label for="message">{{ $locale === 'bn' ? 'আপনার বার্তা' : 'Your message' }}</label><textarea id="message" name="message" rows="5" minlength="10" maxlength="5000" required>{{ old('message') }}</textarea></div>
            <div class="contact-honeypot" aria-hidden="true"><label for="website">Leave this field empty</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
            <button class="button full"><span>{{ $locale === 'bn' ? 'বার্তা পাঠান' : 'Send message' }}</span><span>↗</span></button>
        </form>
    </div>
</section>
@endsection
