@if(Auth::user())
    <div class="breeze-submenu">
        <div class="menu-header">
            <a>{{ Auth::user()->name }}</a>
        </div>
        <ul class="dropdown">
            <li class="menu-option">
                <a href="/dashboard/">Dashboard</a>
            </li>
            <li class="menu-option">
                <a href="/profile/{{ Auth::user()->id}}/">View profile</a>
            </li>
            <li class="menu-option">
                <a href="{{route("profile.edit")}}">Edit profile</a>
            </li>
            <form class="menu-option" method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="/logout" onclick="event.preventDefault();this.closest('form').submit();">Log out</a>
            </form>
        </ul>
    </div>   
@else
    <div class="breeze-submenu">
        <div class="menu-header-link">
            <a href="/login">
                Login / Register
            </a>
        </div>
    </div>
@endif