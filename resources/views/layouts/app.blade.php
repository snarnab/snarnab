@php($portfolioLanguage = request()->cookie('portfolio-language') === 'en' ? 'en' : 'bn')
<!DOCTYPE html>
<html lang="{{ $portfolioLanguage }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $portfolioLanguage === 'en' ? 'Sakib Nihal Arnab — Senior Technical Officer in the CSE department at RUET, web developer, and Rabindra Sangeet artist.' : config('site.description') }}">
    <meta name="theme-color" content="#101a27">
    <title>@yield('title', 'Welcome') · {{ config('site.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="preload" href="{{ asset('fonts/hind-siliguri-400-bengali.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/hind-siliguri-700-bengali.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>
    <header class="site-header">
        <div class="container navigation">
            <a href="{{ route('home') }}" class="brand"><span class="brand-mark">SA<span>✦</span></span>{{ config('site.name') }}<span class="brand-dot">.</span></a>
            <details class="mobile-menu"><summary><span data-bn="মেনু" data-en="Menu">মেনু</span></summary><nav aria-label="Main navigation">@include('partials.navigation')</nav></details>
            <nav class="desktop-nav" aria-label="Main navigation">@include('partials.navigation')</nav>
        </div>
    </header>
    <main id="main">
        @if(session('status'))<div class="container"><div class="alert success" role="status">{{ session('status') }}</div></div>@endif
        @if($errors->any())<div class="container"><div class="alert error" role="alert"><strong><span data-bn="অনুগ্রহ করে তথ্যগুলো যাচাই করুন:" data-en="Please check the following:">অনুগ্রহ করে তথ্যগুলো যাচাই করুন:</span></strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></div>@endif
        @yield('content')
    </main>
    <footer class="site-footer">
        <div class="container footer-top"><div><a class="brand" href="{{ route('home') }}"><span class="brand-mark">SA<span>✦</span></span>{{ config('site.name') }}</a><p><span data-bn="Senior Technical Officer · RUET CSE" data-en="Senior Technical Officer · RUET CSE">Senior Technical Officer · RUET CSE</span></p></div><div class="footer-links"><a href="{{ route('home') }}#projects"><span data-bn="প্রকল্প" data-en="Projects">প্রকল্প</span></a><a href="{{ route('home') }}#experience"><span data-bn="অভিজ্ঞতা" data-en="Experience">অভিজ্ঞতা</span></a><a href="{{ route('about') }}"><span data-bn="পরিচিতি" data-en="About">পরিচিতি</span></a><a href="{{ route('contact') }}"><span data-bn="যোগাযোগ" data-en="Contact">যোগাযোগ</span></a><a href="https://github.com/snarnab?tab=repositories" target="_blank" rel="noopener noreferrer">GitHub ↗</a></div></div>
        <div class="container footer-bottom"><span>© {{ date('Y') }} {{ config('site.name') }}</span><span data-bn="রাজশাহী, বাংলাদেশ · ওয়েব ডেভেলপমেন্ট ও প্রাতিষ্ঠানিক আইটি" data-en="Rajshahi, Bangladesh · Web development and institutional IT">রাজশাহী, বাংলাদেশ · ওয়েব ডেভেলপমেন্ট ও প্রাতিষ্ঠানিক আইটি</span></div>
    </footer>
    <script>
        document.querySelectorAll('[data-bn][data-en]').forEach((element) => {
            element.textContent = element.dataset[document.documentElement.lang];
        });
        document.querySelectorAll('img[data-alt-bn][data-alt-en]').forEach((image) => {
            image.alt = image.dataset[`alt${document.documentElement.lang === 'bn' ? 'Bn' : 'En'}`];
        });
        document.title = document.title.replace('Portfolio', document.documentElement.lang === 'bn' ? 'পোর্টফোলিও' : 'Portfolio');
        document.querySelectorAll('[data-language-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                const language = document.documentElement.lang === 'bn' ? 'en' : 'bn';
                fetch('{{ route('language.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ language }),
                }).then((response) => {
                    if (!response.ok) {
                        throw new Error(`Language change failed with status ${response.status}.`);
                    }

                    window.location.reload();
                }).catch((error) => console.error(error));
            });
        });
    </script>
</body>
</html>
