@extends("layouts.app")

@section("html_title")@yield("title")@endsection

@push("head")
    <link rel="stylesheet" href="/css/app.css?v={{ filemtime("css/app.css") }}">
    @yield("head")
@endpush

@section("body")
    @include("layouts.header", ["condensed" => true])
    <div id="main">
        
        @hasSection("breadcrumbs")
            @yield("breadcrumbs")
        @endif

        @if($errors->any())
            <div class="alert red">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif

        @if(session("status"))
            <div class="alert green">
                {!! session("status") !!}
            </div>
        @endif

        @hasSection("title")
            <h1>@yield("title")</h1>
        @endif

        @yield("content")
        
    </div>
@endsection