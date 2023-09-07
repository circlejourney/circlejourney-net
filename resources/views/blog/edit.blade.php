@extends("layouts.canonical")

@section("title") Edit blog post {{ $blogPost->title }} @endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            [ "href"=>"/blog", "title"=>"Blog" ],
            [ "href"=>"/blog/".$blogPost->id."/edit", "title"=>"Edit ".$blogPost->title ]
        ]
    ])
@endsection

@section("content")
    <form action="" method="post" class="editor">
        @csrf
        @method("PUT")
        
        <label for="title">Post title</label>
        <input class="editor-title" type="text" id="title" name="title" value="{{ $blogPost->title }}">
        
        <br>

        <label for="body">Post body</label>
        <textarea class="editor-body" id="body" name="body">{{ $blogPost->body }}</textarea>
        
        <button id="submit">Update post</button>
    </form>
@endsection