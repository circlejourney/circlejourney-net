@extends("layouts.canonical")

@section("title"){{ "Create New Artwork" }} @endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/artwork-editor", "title"=>"Edit artwork"],
            ["href"=>"/artwork-editor/create", "title"=>"Create new artwork"]
        ]
    ])
@endsection

@section("content")

    <img class="thumbnail" id="preview-image">
    <br>
    <form action="" method="post" class="editor">
        @csrf
        <input class="editor-text" type="text" id="title" name="title" placeholder="Title">
        <textarea class="editor-body" id="description" name="description" placeholder="Description"></textarea>
        <input class="editor-text" type="text" id="thumb_src" name="thumb_src" placeholder="Thumbnail source URL" onchange="$('#preview-image').attr('src', this.value);">
        <input class="editor-text" type="text" id="img_src" name="img_src" placeholder="Image source URL">
        <input class="editor-text" type="text" id="category" name="category" placeholder="category">
        <input class="editor-text" type="number" id="order" name="order" placeholder="Display order">
        <br>
        <button id="submit">Create artwork</button>
    </form>
    <br>
    <form action="" method="post" class="editor">
        @csrf
        @method("DELETE")
        <button id="submit">Delete artwork</button>
    </form>
@endsection