@extends("layouts.app")

@section("html_title"){{ "Links" }}@endsection

@push("head")
    <style>
        @font-face {
            src: url(/resources/fonts/Arvo-Regular.ttf);
            font-weight: normal;
            font-family: Arvo;
        }
        
        body{
            margin: 0;
            padding: 1vh 1vw;
            background-image: url(https://f2.toyhou.se/file/f2-toyhou-se/images/60724018_5JIbTcQVHT9nJA1.jpg);
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
            font-family: Arvo, sans-serif;
        }
        
        .title {
            flex-basis: 100%;
            text-align: center;
        }
        
        .row {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 1020px;
        }  
        
        .link-square {
            height: 250px;
            width: 250px;
            flex-basis: 25%;
            flex-grow: 1;
            box-sizing: border-box;
            padding: 2px;
        }
        
        .link-cap {
            height: 150px;
            flex-basis: 100%;
            padding: 2px;
        }
        
        .link-inside {
            background-color: rgba(50,50,50,0.7);
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            padding: 0.6em;
            
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            
            text-align: center;
            color: white;
            text-decoration: none;
            transition: 0.2s all linear;
        }
        
        a.link-inside:hover {
            color: orchid;
            box-shadow: inset 0 0 10px #333;
        }
        
        .link-cap-top .link-inside {
            border-radius: 200px 200px 0 0;
        }
        
        .link-cap-bottom .link-inside {
            border-radius: 0 0 200px 200px;
        }
        
        .link-header {
            font-size: 16pt;
        }
        
        .link-name {
            font-size: 12pt;
        }
        
        .link-logo {
            height: 1.8rem;
            width: 1.8rem;
        }
        
    </style>
@endpush


@section("body")
<h1 class="title">Links</h1>
<div class="row">
    
    <div class="link-cap link-cap-top">
        <div class="link-inside">
            <span class="link-header">
                Circlejourney
            </span>
        </div>
    </div>

    @forelse($social_links as $social_link)
    <div class="link-square">
        <a class="link-inside" href="{{$social_link->url}}" target="_blank">
            <img class="link-logo" src="https://www.google.com/s2/favicons?sz=64&domain={{$social_link->google_domain}}">
            <span class="link-header">
                 {{$social_link->name}}
            </span>
            @isset($social_link->subtitle)
            <span class="link-name">
                 {{$social_link->subtitle}}
            </span>
            @endisset
        </a>
    </div>
    @endforeach

    
    <div class="link-cap link-cap-bottom">
        <div class="link-inside">
            <span class="link-header">
                And more...
            </span>
        </div>
    </div>
    
</div>
@endsection