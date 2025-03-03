@extends("layouts.canonical")

@section('title'){{ "Fanmusic and invited contributions" }}@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
        ["href"=>"/music", "title"=>"Music"],
        ["href"=>"/music/fanmusic", "title"=>"Fanmusic and invited contributions"]
    ]
    ])
@endsection

@section('content')

    <p class="contents">
        Jump to: 
        <a href="#homestuck">Homestuck</a>
        &bull;
        <a href="#vasterror">Vast Error</a>
        &bull;
        <a href="#su">Steven Universe</a>
        &bull;
        <a href="#others">Other fanmusic</a>
    </p>
    
    <div class="aside">Past versions are included if the track's original sound file has been changed (identical rereleases are not listed). For the thumbnail, I carry over any art specifically made for the track to more recent releases. Unless the art was made by me and I don't like it. Don't worry about it.</div>

    <h2 id="homestuck">Homestuck</h2>
    
    @include("components.thumblist-2columns", ["metalinks" => $homestucklinks])


    <h2 id="vasterror">Vast Error</h2>

    @include("components.thumblist-2columns", ["metalinks" => $vasterrorlinks])
    

    <h2 id="su">Steven Universe</h2>

    @include("components.thumblist-2columns", ["metalinks" => $sulinks])

    <h2 id="others">Other fanmusic</h2>

    @include("components.thumblist-2columns", ["metalinks" => $otherlinks])

@endsection