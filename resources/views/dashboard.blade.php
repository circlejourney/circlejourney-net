@extends("layouts.canonical")
    @section("title")
        Dashboard
    @endsection
@section('content')
    <p>You're logged in! Get started:</p>
    
    <ul>
        <li><a href="/blog/">Create a blog post</a> (Note that you can only create blog posts if you have updated your bio.)</li>
        <li><a href="/">Visit the homepage</a></li>
        <li><a href="/profile/">Edit your profile</a></li>
    </ul>
@endsection