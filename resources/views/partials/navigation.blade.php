<a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
<a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a>
<a href="{{ route('projects.index') }}" @class(['active' => request()->routeIs('projects.*')])>Projects</a>
<a href="{{ route('freelancing') }}" @class(['active' => request()->routeIs('freelancing')])>Freelancing</a>
<a href="{{ route('music.index') }}" @class(['active' => request()->routeIs('music.*')])>Music</a>
<a href="{{ route('photography.index') }}" @class(['active' => request()->routeIs('photography.*')])>Photography</a>
<a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact</a>
@auth
    <a href="{{ route('dashboard') }}" @class(['active' => request()->routeIs('dashboard')])>Dashboard</a>
    <a href="{{ route('profile.edit') }}">Account profile</a>
    @if(auth()->user()->is_admin && auth()->user()->hasVerifiedEmail())
        <a href="{{ route('admin.dashboard') }}">Admin</a>
    @endif
    <form method="POST" action="{{ route('logout') }}">@csrf<button class="button small secondary">Log out</button></form>
@endauth
