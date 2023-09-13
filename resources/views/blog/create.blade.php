@extends("layouts.canonical")

@section("title"){{ "Create new blog post" }}@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/blog", "title"=>"Blog"],
            ["href"=>"/blog/create", "title"=>"Create new blog post"],
        ]
    ])
@endsection

@section("content")
    <form action="" method="post" class="editor">
        @csrf
        <label for="title">Post title</label>
        <input class="editor-title" type="text" id="title" name="title">
        
        <br>

        <label for="body">Post body</label>
        <textarea class="editor-body" id="body" name="body"></textarea>
        
        <button id="submit">Post</button>
    </form>
@endsection