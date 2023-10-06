@extends("layouts.canonical")

@section("title"){{ "Edit Artwork: ".$artwork->title }} @endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/artwork-editor", "title"=>"Edit artwork"],
            ["href"=>"/artwork-editor/".$artwork->id, "title"=>$artwork->title]
        ]
    ])
@endsection

@section("content")

    <img class="thumbnail" id="preview-image" src="{{ $artwork->img_src }}">
    <br>
    <form action="" method="post" class="editor">
        @csrf
        @method("PUT")
        <input class="editor-text" type="text" id="title" name="title" value="{{ $artwork->title }}" placeholder="Title">
        <textarea class="editor-body" id="description" name="description">{{ $artwork->description }}</textarea>
        <input class="editor-text" type="text" id="thumb_src" name="thumb_src" value="{{ $artwork->thumb_src }}" placeholder="Thumbnail source URL" onchange="$('#preview-image').attr('src', this.value);">
        <input class="editor-text" type="text" id="img_src" name="img_src" value="{{ $artwork->img_src }}" placeholder="Image source URL">
        <input class="editor-text" type="text" id="category" name="category" value="{{ $artwork->category }}" placeholder="category">
        <input class="editor-text" type="number" id="order" name="order" value="{{  $artwork->order }}" placeholder="Display order">
        <br>
        <button id="submit">Update artwork</button>
    </form>
    <br>
    <form action="" method="post" class="editor">
        @csrf
        @method("DELETE")
        <button id="submit">Delete artwork</button>
    </form>
@endsection