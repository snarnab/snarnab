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
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    <script type="application/ld+json">@json($personSchema)</script>
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>
    <header class="site-header">
        <div class="container navigation">
            <a href="{{ route('home') }}" class="brand header-brand" aria-label="{{ config('site.name') }} home"><span class="brand-mark">SNA</span></a>
            <details class="mobile-menu"><summary>Menu</summary><nav aria-label="Main navigation">@include('partials.navigation')</nav></details>
            <nav class="desktop-nav" aria-label="Main navigation">@include('partials.navigation')</nav>
        </div>
    </header>
    <main id="main">
        @if(session('status'))<div class="container"><div class="alert success" role="status">{{ session('status') }}</div></div>@endif
        @if($errors->any())<div class="container"><div class="alert error" role="alert"><strong>Please review the following details:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></div>@endif
        @yield('content')
    </main>
    <footer class="site-footer">
        <div class="container footer-top">
            <div><a class="brand" href="{{ route('home') }}"><span class="brand-mark">SA</span><span>{{ config('site.name') }}</span></a><p>Senior Technical Officer · RUET CSE</p></div>
            <nav class="footer-links" aria-label="Footer navigation">
                <a href="{{ route('projects.index') }}">Projects</a>
                <a href="{{ route('music.index') }}">Music</a>
                <a href="{{ route('photography.index') }}">Photography</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('contact') }}">Contact</a>
                <a href="https://github.com/snarnab?tab=repositories" target="_blank" rel="noopener noreferrer">GitHub ↗</a>
            </nav>
        </div>
        <div class="container footer-bottom"><span>© {{ date('Y') }} {{ config('site.name') }}</span><span>Rajshahi, Bangladesh · Web development and institutional IT</span></div>
    </footer>
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
