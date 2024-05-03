@extends("layouts.canonical")

@section('title'){{ "Offshore" }}@endsection

@section('content')
    @section("breadcrumbs")
        @include("components.breadcrumbs", ["crumbs" => [
            ["href" => route("writing"), "title" => "Writing"],
            ["href" => Route::current()->getName(), "title" => "Offshore" ]
        ] ])
    @endsection

    <p class="center">
        <img src="https://f2.toyhou.se/file/f2-toyhou-se/images/58358955_wT4g18nwzsQ34T7.jpg?1670860926" style="max-height: 500px; display: inline;" alt="A cover image for Offshore, featuring two characters floating in the air towards the top left of the image, over ocean waves and seafoam. A race yacht's sail rises in the background.">
    </p>
    <blockquote>
        <p>
        Things had gone south two hours into today’s run of the bay. When a rogue gust had led into a poorly timed jibe, it had only taken seconds for the Cloudlander to swerve wildly and fling them into the blustery waves below. 
        </p>
        <p>
            Rookie mistake. And they should be embarrassed.
        </p>
        <p>
        But feeling their water shoes skid on plastic and their shoulders smash against the waves, a strange, breathless thought had pierced through their shame like the glare of the sun. In that split second of zero-gravity, terminal velocity before they collided with reality and the sea, Anqien’s heart had raced at the thought that they were doing this with <i>her</i>. Dazzling, impossible, shooting star Jinai—
        </p>
    </blockquote>
    <p>
        Celebrity sailor Jinai has decided to quit the sport, after one last race. Her teammate Anqien, who was hired to replace a disgraced member, has long feared that they'll never match Jinai or her towering expectations. Crewing a yacht named the Cloudlander, this disastrous duo will make one final attempt at winning the biggest offshore race in the world—a title that has long eluded them. But will their mutual anxieties and unacknowledged romantic feelings upend them first?
    </p>

    <h2>Read it</h2>

    <p class="center">
        <x-badge-link href="https://circlejourney.net/read/?story=offshore">Circlejourney read app</x-badge-link>
        <x-badge-link href="https://toyhou.se/~literature/162349.offshore">Circlejourney read app</x-badge-link>
        <x-badge-link href="https://tapas.io/series/offshore-novel/info">Tapas</x-badge-link>
    </p>
    
    <h2>Other links</h2>
    <p class="center">

        <x-badge-link href="https://circlejourney.net/read/?story=offshore-stories">Offshore side stories</x-badge-link>
        <x-badge-link href="https://circlejourney.net/offshore/wall">Art wall</x-badge-link>
        <x-badge-link href="/music/theskybeyondourbay">The Sky Beyond Our Bay (album)</x-badge-link>

        <x-badge-link href="https://www.youtube.com/watch?v=51FQr-lG3DU" background_image="https://rebuild.circlejourney.net/uploads/art/ewi3-md.gif" background_position="center 27%" dark>Everybody Wants It (animation)</x-badge-link>
        
        <x-badge-link href="https://www.youtube.com/watch?v=ULkW_tcyIG0" 
        background_image="https://f2.toyhou.se/file/f2-toyhou-se/images/63376009_UkwZzUsUPUBPrNd.gif?1689075993"
        background_position="50%" dark>Learn How To Surf (animation)</x-badge-link>
        <x-badge-link href="https://toyhou.se/circlejourney/characters/folder:3442068">Character profiles</x-badge-link>
        <x-badge-link href="https://toyhou.se/20496317.offshore-masterpost/20496327.cloudlanders-ship-profile">Relationship profile</x-badge-link>
        <x-badge-link href="https://toyhou.se/20496317.offshore-masterpost/20496333.meta-information">Meta information</x-badge-link>

    </p>

    <h2>Gallery</h2>
    <x-gallery :$artworks />

@endsection