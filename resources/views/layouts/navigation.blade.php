@if(Auth::user())
    <x-dropdown>
        <x-slot name="header">
            {{ Auth::user()->name }}
        </x-slot>
        
        <x-slot name="content">
            <x-dropdown-link :href="route('dashboard')">
                {{ __('Dashboard') }}
            </x-dropdown-link>

            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>

            <!-- Authentication -->
            <form class="menu-option" method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="/logout" onclick="event.preventDefault();this.closest('form').submit();">Log out</a>
            </form>
        </x-slot>
    </x-dropdown>        
@else
    <div class="breeze-submenu">
        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
            {{ __('Login') }}
        </x-nav-link>
    </div>
@endif