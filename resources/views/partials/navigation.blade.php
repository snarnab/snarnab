<a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])><span data-bn="হোম" data-en="Home">হোম</span></a>
<a href="{{ route('home') }}#about"><span data-bn="পরিচিতি" data-en="About">পরিচিতি</span></a>
<a href="{{ route('home') }}#expertise"><span data-bn="দক্ষতা" data-en="Expertise">দক্ষতা</span></a>
<a href="{{ route('home') }}#projects"><span data-bn="প্রকল্প" data-en="Projects">প্রকল্প</span></a>
<a href="{{ route('home') }}#experience"><span data-bn="অভিজ্ঞতা" data-en="Experience">অভিজ্ঞতা</span></a>
<a href="{{ route('home') }}#contact"><span data-bn="যোগাযোগ" data-en="Contact">যোগাযোগ</span></a>
<button type="button" class="language-toggle" data-language-toggle><span data-bn="EN" data-en="বাংলা">EN</span></button>
@auth
    <a href="{{ route('dashboard') }}" @class(['active' => request()->routeIs('dashboard')])>Dashboard</a>
    <a href="{{ route('profile.edit') }}">My profile</a>
    <form method="POST" action="{{ route('logout') }}">@csrf<button class="button small secondary">Log out ↗</button></form>
@endauth
