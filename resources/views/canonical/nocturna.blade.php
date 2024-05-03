@extends("layouts.projects", ["projects" => $projects])

@section('title'){{ "Nocturna" }}@endsection

@section('top')
    @section("breadcrumbs")
        @include("components.breadcrumbs", ["crumbs" => [
            ["href" => route("interactive"), "title" => "Interactive projects and games"],
            ["href" => Route::current()->getName(), "title" => "Nocturna" ]
        ] ])
    @endsection

<p>A magician who has averted death one too many times. A luck black hole who's swindled casinoes to bankruptcy. Nocturna is a story of necromancy, curses and everything spooky, in a world where death in every country is a bureaucracy run by the worst beings for the job.</p>
@endsection

@section('bottom')

<div class="center">
    <x-badge-link href="https://toyhou.se/circlejourney/characters/folder:854617">Character profiles</x-badge-link>
    <x-badge-link href="https://circlejourney.net/interactive/nocturna/prototype02.html">Nocturna prototype game (2016)</x-badge-link>
</div>

<hr>

<h2>About</h2>
<p>I began <i>Nocturna</i> as an animation concept in 2016. The animation never got beyond character sheets and a few animation roughs. But the project decided to evolve into a much broader concept after I joined Toyhouse&mdash;one that was centred not around a singular work, but around the characters. I ended up creating two games, a comic, some music, and loads of characters under its umbrella.</p>
<p><i>Nocturna</i> has ended up being a highly character-focused project: the characters are most of the artistry, seen on their Toyhouse profiles. I got a few friends to design their favourite death deities for the project, too! Someday, I'd still love to make that side-scrolling platformer that I dreamed of back then, but till then, I hope you enjoy the character profiles.</p>

<x-gallery :$artworks></x-gallery>

@endsection