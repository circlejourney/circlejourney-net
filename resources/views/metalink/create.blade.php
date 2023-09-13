@extends("layouts.canonical")

@section("title") Create metalink @endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/metalink-editor", "title"=>"Edit metalinks"],
            ["href"=>"/metalink-editor/create", "title"=> "Create metalink"]
        ]
    ])
@endsection

@section("content")
    <img id="preview-image">
    <form action="" method="post" class="editor">
        @csrf
        <input class="editor-title" type="text" id="item_id" name="item_id" placeholder="Item ID (no spaces)">
        <input class="editor-title" type="text" id="href" name="href" placeholder="URL">
        <input class="editor-title" type="text" id="img_src" name="img_src" placeholder="Image source URL" onchange="$('#preview-image').attr('src', this.value);">
        <input class="editor-title" type="text" id="category" name="category" placeholder="Category">
        <input class="editor-title" type="text" id="title" name="title" placeholder="Title">
        <textarea class="editor-body" id="description" name="description"></textarea>
        <input class="editor-title" type="text" id="publish_date" name="publish_date" placeholder="Publish date Y-M-D H:M:S">
        <input class="editor-title" type="number" id="track_number" name="track_number" placeholder="Track number">
        <button id="submit">Create metalink</button>
    </form>
@endsection