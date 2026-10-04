<a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])><span data-bn="হোম" data-en="Home">হোম</span></a>
<a href="{{ route('home') }}#about"><span data-bn="পরিচিতি" data-en="About">পরিচিতি</span></a>
<a href="{{ route('home') }}#expertise"><span data-bn="দক্ষতা" data-en="Expertise">দক্ষতা</span></a>
<a href="{{ route('projects.index') }}"><span data-bn="প্রকল্প" data-en="Projects">প্রকল্প</span></a>
<a href="{{ route('home') }}#experience"><span data-bn="অভিজ্ঞতা" data-en="Experience">অভিজ্ঞতা</span></a>
<a href="{{ route('music.index') }}"><span data-bn="সংগীত" data-en="Music">সংগীত</span></a>
<a href="{{ route('photography.index') }}"><span data-bn="ফটোগ্রাফি" data-en="Photography">ফটোগ্রাফি</span></a>
<a href="{{ route('home') }}#contact"><span data-bn="যোগাযোগ" data-en="Contact">যোগাযোগ</span></a>
<button type="button" class="language-toggle" data-language-toggle><span data-bn="EN" data-en="বাংলা">EN</span></button>
<button type="button" class="theme-toggle" data-theme-toggle aria-label="Switch color theme"><span aria-hidden="true">◐</span><span data-bn="থিম" data-en="Theme">থিম</span></button>
@auth
    <a href="{{ route('dashboard') }}" @class(['active' => request()->routeIs('dashboard')])>Dashboard</a>
    <a href="{{ route('profile.edit') }}">My profile</a>
    @if(auth()->user()->is_admin && auth()->user()->hasVerifiedEmail())
        <a href="{{ route('admin.dashboard') }}">Admin</a>
    @endif
    <form method="POST" action="{{ route('logout') }}">@csrf<button class="button small secondary">Log out ↗</button></form>
@endauth
