<div class="topbar">
    <a class="home-button" href="/"><i class="fa fa-home"></i></a>
    <a class="linklist-button" target = "_blank" href = "mailto:circlejourneyart@gmail.com"><i class = "fas fa-envelope"></i></a>
    <a class="linklist-button" target = "_blank" href = "http://twitter.com/circlejourney"><i class = "fab fa-twitter"></i></a>
    <a class="linklist-button" target = "_blank" href = "http://instagram.com/circlejourneyart"><i class = "fab fa-instagram"></i></a>
    <a class="linklist-button" target = "_blank" href = "http://circlejourneyart.tumblr.com"><i class = "fab fa-tumblr"></i></a>
    <a class="linklist-button" target = "_blank" href = "http://facebook.com/circlejourneyart"><i class = "fab fa-facebook"></i></a>
    <a class="linklist-button" target = "_blank" href = "http://circlejourney.bandcamp.com"><i class = "fa fa-music"></i></a>
    <a class="linklist-button" target = "_blank" href = "https://www.linkedin.com/in/amari-low-29494b87/"><i class = "fab fa-linkedin"></i></a>
    <a class="linklist-button" href = "/links"><i class = "fa fa-chain"></i> Link list</a>
    @include("layouts.navigation")
</div>

<a id="blog-title" href="/">
    <div id="blog-title-image-holder" class="blur">
    </div>
    <div id="blog-title-inside">
        <div class="blog-title-headline">
            <img id="blog-title-logo" class="transparent"> <span>Circlejourney</span>
        </div>
        
        <div class="center" style="font-family: Arvo; font-size: 10pt; text-shadow: 0 0 10px #eee;">⚠️ This site is still being ported! Some links will take you back to my original domain, <code>circlejourney.net</code>.</div>
    
    </div>
</a>

<div class="menu" id="menu">
    <div id="menu-button" onclick = '$("#menu").toggleClass("visible");'><i class = "fa fa-bars"></i></div>

    <div class="submenu">
        <div class="menu-header-link">
            <a href="/blog/">Blog</a>
        </div>
    </div>
    
    <div class="submenu">
        <div class="menu-header"><a>Art & comics</a></div>
        <ul class="dropdown">
        <x-menu-option href="/art/">Art home</x-menu-option>
        <x-menu-option href="https://comics.circlejourney.net">Comics home</x-menu-option>
        <x-menu-option href="https://circlejourney.carrd.co">Commissions</x-menu-option>
        <x-menu-option href="http://circlejourney.weebly.com">Portfolio</x-menu-option>
        <x-menu-option href="https://compass.circlejourney.net">Compass (2017-2020)</x-menu-option>
        <x-menu-option href="https://light.circlejourney.net">The Light Left Under Trees (2019-)</x-menu-option>
        <x-menu-option href="https://comics.circlejourney.net/dusk">Dusk: Unbirth (2016)</x-menu-option>
        <x-menu-option href="https://comics.circlejourney.net/snow-white">A Retelling of Snow White (2016)</x-menu-option>
        </ul>
    </div>
    
    <div class="submenu">
        <div class="menu-header"><a>Writing</a></div>
        <ul class="dropdown">
        <x-menu-option href="/writing/">Writing home</x-menu-option>
        <x-menu-option href="https://rd.circlejourney.net">Revolving Door</x-menu-option>
        <x-menu-option href="/writing/offshore/">Offshore</x-menu-option>
        <x-menu-option href="/writing/eaglesandswans/">Eagles and Swans</x-menu-option>
        <x-menu-option href="/writing/otdots/">Of the Dragon, of the Stars</x-menu-option>
        <x-menu-option href="/writing/compass/">Compass</x-menu-option>
        <x-menu-option href="/writing/islandwars/">Island Wars</x-menu-option>
        <x-menu-option href="/writing/voca/">Voca</x-menu-option>
        <x-menu-option href="/writing/shortstories/">Short stories</x-menu-option>
        </ul>
    </div>
    
    <div class="submenu">
        <div class = "menu-header"><a>Interactive</a></div>
        <ul class="dropdown">
        <x-menu-option href="/interactive/">Interactive home</x-menu-option>
        <x-menu-option href="https://compass.circlejourney.net">Compass</x-menu-option>
        <x-menu-option href="https://th.circlejourney.net">Toyhouse editor</x-menu-option>
        <li class= "menu-mini-header">GPS</li>
        <x-menu-option href="/water/">Bubblers and Drinking Fountains Map</x-menu-option>
        <x-menu-option href="/spectralcarta/">The Spectral Carta</x-menu-option>
        <li class= "menu-mini-header">Games</li>
        <x-menu-option href="/in-between/">In Between</x-menu-option>
        <x-menu-option href="/angel/">Angel</x-menu-option>
        <x-menu-option href="/swim/">Swim!</x-menu-option>
        <li class= "menu-mini-header">Fun</li>
        <x-menu-option href="/p5/islands/">Islands</x-menu-option>
        <x-menu-option href="/petridish/">Petri Dish</x-menu-option>
        </ul>
    </div>
    
    <div class="submenu">
    <div class="menu-header"><a>Music</a></div>
    <ul class="dropdown">
    <x-menu-option href="/music/">Music home</x-menu-option>
    <x-menu-option href="/music/fanmusic/">Fanmusic and invited contributions</x-menu-option>
    <x-menu-option href="/music/whereveryouwere/">Wherever You Were (2023)</x-menu-option>
    <x-menu-option href="/music/theskybeyondourbay/">The Sky Beyond Our Bay (2023)</x-menu-option>
    <x-menu-option href="/music/flyways/">Flyways (2021)</x-menu-option>
    <x-menu-option href="/music/amemoryfindsitsname/">A Memory Finds Its Name (2021)</x-menu-option>
    <x-menu-option href="/music/theskyisours/">The sky is ours (2020)</x-menu-option>
    <x-menu-option href="/music/thechanginglight/">The Changing Light (2019)</x-menu-option>
    <x-menu-option href="/music/timeandtide/">Time and Tide (2018)</x-menu-option>
    <x-menu-option href="/music/someotherhorizon/">Some Other Horizon (2016)</x-menu-option>
    <x-menu-option href="/music/betweenskyandsea/">Between Sky and Sea (2016)</x-menu-option>
    <x-menu-option href="/music/coastaldreaming/">Coastal Dreaming (2015)</x-menu-option>
    <x-menu-option href="/music/worldsawait/">Worlds Await (2013)</x-menu-option>
    <x-menu-option href="/music/compass/">Compass (2013)</x-menu-option>
    </ul>
    </div>
    
    <div class = "submenu">
        <div class="menu-header-link"><a href="/collabs/">Community projects</a></div>
    </div>

</div>