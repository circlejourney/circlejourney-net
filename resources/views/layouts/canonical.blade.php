@extends("layouts.app")

@section("html_title") @yield("title") @endsection

@push("head")
    <link rel="stylesheet" href="/css/app.css">
    <!--@ vite('resources/css/app.css')-->
    @yield("head")
@endpush

@section("body")
    @include("layouts.header")
    <div id="lightbox" onclick="this.style.display='none'"><img id="lightboxImage"/></div>
    <div id="main" onclick = "document.getElementsByClassName('menu')[0].className = 'menu'">
        
        @hasSection("breadcrumbs")
            @yield("breadcrumbs")
        @endif

        @if($errors->any())
            <div class="alert">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif

        @hasSection("title")
            <h1>@yield("title")</h1>
        @endif

        @yield("content")
        
    </div>
@endsection