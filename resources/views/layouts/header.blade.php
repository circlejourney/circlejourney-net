<div class="topbar">
    <a class="home-button" href="/"><i class="fa fa-home"></i></a>
    <a target="_blank" href="https://bsky.app/profile/circlejourney.net" class="linklist-button" aria-label="Bluesky"><i class="fab fa-bluesky"></i></a>
    <a target="_blank" href="http://github.com/circlejourney" class="linklist-button" aria-label="Github"><i class="fab fa-github"></i></a>
    <a href="https://new.circlejourney.net/links" class="linklist-button"><i class="fa fa-chain"></i> Link list</a> &bull; admin@circlejourney.net
    @include("layouts.navigation")
</div>

@isset($condensed)
    <a id="blog-title" class="condensed" href="/">
        <div id="blog-title-inside">
            <div class="blog-title-headline">
                <img id="blog-title-logo" class="transparent"> <span>Circlejourney</span>
            </div>
        </div>
    </a>
@else
    @include("layouts.banner")
@endisset

<div class="menu" id="menu">
    <div id="menu-button" onclick = '$("#menu").toggleClass("visible");'><i class = "fa fa-bars"></i></div>
    
    <div class="submenu">
        <div class="menu-header-link"><a href="https://circlejourney.net/" class="menu-trigger">Original Site</a></div>
    </div>
    
    <div class="submenu">
        <div class="menu-header menu-trigger">Art & comics</div>
        <ul class="dropdown">
        <x-menu-option href="/art/">Art and comics home</x-menu-option>
        <x-menu-option href="https://circlejourney.net/commissions">Commissions</x-menu-option>
        <x-menu-option href="http://circlejourney.weebly.com" target="_blank">Art and design portfolio</x-menu-option>
        <x-menu-option href="https://comics.circlejourney.net">Comics home</x-menu-option>
        </ul>
    </div>
    
    <div class="submenu">
        <div class="menu-header menu-trigger" tabindex="0">Writing</div>
        <ul class="dropdown">
        <x-menu-option href="/writing/">Writing home</x-menu-option>
        <x-menu-option href="https://circlejourney.net/writing/blog">Writing blog</x-menu-option>
        <x-menu-option href="/writing/portfolio">Writing portfolio</x-menu-option>
        </ul>
    </div>
    
    <div class="submenu">
        <div class = "menu-header menu-trigger" tabindex="0">Interactive</div>
        <ul class="dropdown">
            <x-menu-option href="/interactive/">Interactive home</x-menu-option>
            <x-menu-option href="https://portfolio.circlejourney.net">Web development portfolio</x-menu-option>
            <x-menu-option href="https://compass.circlejourney.net">Compass</x-menu-option>
            <x-menu-option href="https://th.circlejourney.net">Toyhouse editor</x-menu-option>
            <x-menu-option href="https://circlejourney.net/in-between/">In Between</x-menu-option>
            <x-menu-option href="https://circlejourney.net/spectralcarta/">The Spectral Carta</x-menu-option>
        </ul>
    </div>
    
    <div class="submenu">
    <div class="menu-header menu-trigger" tabindex="0">Music</div>
    <ul class="dropdown">
        <x-menu-option href="/music/">Music home</x-menu-option>
        <x-menu-option href="/music/fanmusic/">Fanmusic and invited contributions</x-menu-option>
        <x-menu-option href="https://circlejourney.carrd.co#music">Music commissions</x-menu-option>
        <x-menu-option href="https://circlejourney.net/music/intro">Introduction to my music</x-menu-option>
    </ul>
    </div>
    
    <div class="submenu">
        <div class="menu-header-link"><a href="/collabs/" class="menu-trigger">Community projects</a></div>
    </div>
    

</div>