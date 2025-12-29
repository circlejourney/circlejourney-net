@extends("layouts.canonical")
    @section("title"){{ "Dashboard" }}@endsection
@section('content')
    <p>You're logged in! Get started:</p>
    
    <ul>
        <li><a href="/blog/">Create a blog post</a> (Note that you can only create blog posts if you have updated your bio.)</li>
        <li><a href="/">Visit the homepage</a></li>
        <li><a href="/profile/">Edit your profile</a></li>
        @if(Auth::user()->hasRank("admin"))
            <li><a href="/upload/">Upload files</a></li>
            <li><a href="/project-editor/">Edit projects</a></li>
            <li><a href="/artwork-editor/">Edit artwork</a></li>
            <li><a href="/metalink-editor/">Edit metalinks</a></li>
            <li><a href="/album-editor/">Edit albums</a></li>
        @endif
    </ul>
@endsection