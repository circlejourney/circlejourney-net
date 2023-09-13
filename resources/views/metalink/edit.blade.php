@extends("layouts.canonical")

@section("title"){{ "Edit Metalink: ".$metalink->title }} @endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/metalink-editor", "title"=>"Edit metalinks"],
            ["href"=>"/metalink-editor/".$metalink->id, "title"=>$metalink->title]
        ]
    ])
@endsection

@section("content")
    <img id="preview-image" src="{{ $metalink->img_src }}">
    <form action="" method="post" class="editor">
        @csrf
        @method("PUT")
        <input class="editor-text" type="text" id="item_id" name="item_id" placeholder="Item ID (no spaces)" value="{{ $metalink->item_id }}">
        <input class="editor-text" type="text" id="href" name="href" value="{{ $metalink->href }}" placeholder="URL">
        <input class="editor-text" type="text" id="img_src" name="img_src" value="{{ $metalink->img_src }}" placeholder="Image source URL" onchange="$('#preview-image').attr('src', this.value);">
        <input class="editor-text" type="text" id="category" name="category" value="{{ $metalink->category }}" placeholder="category">
        <input class="editor-text" type="text" id="title" name="title" value="{{ $metalink->title }}" placeholder="Title">
        <textarea class="editor-body" id="description" name="description">{{ $metalink->description }}</textarea>
        <input class="editor-text" type="text" id="publish_date" name="publish_date" placeholder="Publish date Y-M-D H:M:S" value="{{ $metalink->publish_date }}">
        <input class="editor-text" type="number" id="track_number" name="track_number" placeholder="Number for ordering releases on the same date" value="{{ $metalink->track_number }}">
        <br>
        <button id="submit">Update metalink</button>
    </form>
    <br>
    <form action="" method="post" class="editor">
        @csrf
        @method("DELETE")
        <button id="submit">Delete metalink</button>
    </form>
@endsection