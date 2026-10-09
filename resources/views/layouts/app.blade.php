@php($personSchema = ['@context' => 'https://schema.org', '@type' => 'Person', 'name' => config('site.name'), 'url' => route('home'), 'image' => asset('images/sakib-portrait.jpg'), 'jobTitle' => 'Senior Technical Officer', 'worksFor' => ['@type' => 'CollegeOrUniversity', 'name' => 'Rajshahi University of Engineering & Technology'], 'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Rajshahi', 'addressCountry' => 'BD'], 'sameAs' => $schemaSocialLinks])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', 'Sakib Nihal Arnab — Senior Technical Officer in the CSE department at RUET, software and web developer, and Rabindra Sangeet artist.')">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', config('site.name')) · {{ config('site.name') }}">
    <meta property="og:description" content="@yield('description', config('site.description'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/sakib-portrait.jpg') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#0B1F33">
    <title>@yield('title', 'Welcome') · {{ config('site.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}?v={{ filemtime(public_path('favicon.png')) }}" type="image/png" sizes="64x64">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}?v={{ filemtime(public_path('css/portfolio.css')) }}">
    <script type="application/ld+json">@json($personSchema)</script>
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>
    <header class="site-header">
        <div class="container navigation">
            <details class="mobile-menu"><summary>Menu</summary><nav aria-label="Main navigation">@include('partials.navigation')</nav></details>
            <nav class="desktop-nav" aria-label="Main navigation">@include('partials.navigation')</nav>
            <nav class="header-contact-links" aria-label="Contact links">
                @if($headerContactSettings->has('contact_email'))
                    <a href="mailto:{{ $headerContactSettings['contact_email']->value_en }}" aria-label="Email Sakib Nihal Arnab" title="Email"><span class="header-contact-label">Email</span>@include('partials.contact-icon', ['type' => 'email'])</a>
                @endif
                @if($headerContactSettings->has('phone'))
                    @php($whatsappNumber = preg_replace('/[^0-9]/', '', $headerContactSettings['phone']->value_en))
                    <a href="https://wa.me/{{ $whatsappNumber }}" aria-label="WhatsApp Sakib Nihal Arnab" title="WhatsApp" target="_blank" rel="noopener noreferrer"><span class="header-contact-label">WhatsApp</span>@include('partials.contact-icon', ['type' => 'whatsapp'])</a>
                @endif
                @if($headerContactSettings->has('phone'))
                    <a href="tel:{{ preg_replace('/[^+0-9]/', '', $headerContactSettings['phone']->value_en) }}" aria-label="Call Sakib Nihal Arnab" title="Phone"><span class="header-contact-label">Phone</span>@include('partials.contact-icon', ['type' => 'phone'])</a>
                @endif
                @foreach($headerSocialLinks as $link)
                    <a href="{{ $link->url }}" aria-label="{{ $link->platform }}" title="{{ $link->platform }}" target="_blank" rel="noopener noreferrer"><span class="header-contact-label">{{ $link->platform }}</span>@include('partials.contact-icon', ['type' => strtolower($link->platform)])</a>
                @endforeach
            </nav>
        </div>
    </header>
    <main id="main">
        @if(session('status'))<div class="container"><div class="alert success" role="status">{{ session('status') }}</div></div>@endif
        @if($errors->any())<div class="container"><div class="alert error" role="alert"><strong>Please review the following details:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></div>@endif
        @yield('content')
    </main>
    <footer class="site-footer">
        <div class="container footer-main">
            <div class="footer-identity">
                <a class="footer-brand" href="{{ route('home') }}">
                    <span><strong>{{ config('site.name') }}</strong><small>Senior Technical Officer · RUET CSE</small></span>
                </a>
                @if($headerContactSettings->has('office'))
                    <p class="footer-office-address">{{ $headerContactSettings['office']->value_en }}</p>
                @endif
                <nav class="footer-social-links" aria-label="Social links">
                    @foreach($headerSocialLinks as $link)
                        <a href="{{ $link->url }}" aria-label="{{ $link->platform }}" title="{{ $link->platform }}" target="_blank" rel="noopener noreferrer">@include('partials.contact-icon', ['type' => strtolower($link->platform)])</a>
                    @endforeach
                </nav>
            </div>
            <div class="footer-column">
                <p>Explore</p>
                <nav aria-label="Explore"><a href="{{ route('projects.index') }}">Projects</a><a href="{{ route('freelancing') }}">Freelancing</a><a href="{{ route('about') }}">About</a><a href="{{ route('contact') }}">Contact</a></nav>
            </div>
            <div class="footer-column">
                <p>Creative work</p>
                <nav aria-label="Creative work"><a href="{{ route('music.index') }}">Music</a><a href="{{ route('photography.index') }}">Photography</a><a href="https://github.com/snarnab?tab=repositories" target="_blank" rel="noopener noreferrer">GitHub <span aria-hidden="true">↗</span></a></nav>
            </div>
            <div class="footer-cta"><p>Have a practical project in mind?</p><strong>Let’s build something useful.</strong><a href="{{ route('contact') }}">Start a conversation <span aria-hidden="true">→</span></a></div>
        </div>
        <div class="container footer-bottom"><span>© {{ date('Y') }} {{ config('site.name') }}</span><span>Designed and developed by Sakib Nihal Arnab</span></div>
    </footer>
    <nav class="mobile-dock" aria-label="Mobile navigation">
        <a href="{{ route('home') }}" aria-label="Home" title="Home" @if(request()->routeIs('home')) aria-current="page" @endif @class(['active' => request()->routeIs('home')])><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 10 9-7 9 7v10H3Z"/><path d="M9 20v-7h6v7"/></svg></a>
        <a href="{{ route('about') }}" aria-label="About" title="About" @if(request()->routeIs('about')) aria-current="page" @endif @class(['active' => request()->routeIs('about')])><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="7" r="4"/><path d="M4 21v-2a8 8 0 0 1 16 0v2"/></svg></a>
        <a href="{{ route('projects.index') }}" aria-label="Projects" title="Projects" @if(request()->routeIs('projects.*')) aria-current="page" @endif @class(['active' => request()->routeIs('projects.*')])><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="7" width="18" height="14" rx="2"/><path d="M8 7V3h8v4M3 12h18"/></svg></a>
        <a href="{{ route('freelancing') }}" aria-label="Freelancing" title="Freelancing" @if(request()->routeIs('freelancing')) aria-current="page" @endif @class(['active' => request()->routeIs('freelancing')])><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="13" rx="2"/><path d="M8 21h8M12 17v4m-4-9 3 2 5-5"/></svg></a>
        <a href="{{ route('music.index') }}" aria-label="Music" title="Music" @if(request()->routeIs('music.*')) aria-current="page" @endif @class(['active' => request()->routeIs('music.*')])><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18V5l11-2v13M9 9l11-2"/><ellipse cx="6" cy="18" rx="3" ry="3"/><ellipse cx="17" cy="16" rx="3" ry="3"/></svg></a>
        <a href="{{ route('photography.index') }}" aria-label="Photography" title="Photography" @if(request()->routeIs('photography.*')) aria-current="page" @endif @class(['active' => request()->routeIs('photography.*')])><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 6l2-3h4l2 3h4a1 1 0 0 1 1 1v13H3V7a1 1 0 0 1 1-1Z"/><circle cx="12" cy="13" r="4"/></svg></a>
        <a href="{{ route('contact') }}" aria-label="Contact" title="Contact" @if(request()->routeIs('contact')) aria-current="page" @endif @class(['active' => request()->routeIs('contact')])><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 6 9 7 9-7"/></svg></a>
    </nav>
    <script>
        const galleryDialog = document.querySelector('[data-gallery-dialog]');
        if (galleryDialog) {
            document.querySelectorAll('[data-gallery-image]').forEach((button) => {
                button.addEventListener('click', () => {
                    galleryDialog.querySelector('[data-gallery-dialog-image]').src = button.dataset.galleryImage;
                    galleryDialog.querySelector('[data-gallery-dialog-caption]').textContent = button.dataset.galleryCaption || '';
                    galleryDialog.showModal();
                });
            });
            galleryDialog.querySelector('.gallery-close').addEventListener('click', () => galleryDialog.close());
            galleryDialog.addEventListener('click', (event) => {
                if (event.target === galleryDialog) {
                    galleryDialog.close();
                }
            });
        }
    </script>
</body>
</html>
