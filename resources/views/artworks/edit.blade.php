@extends("layouts.canonical")

@section("title"){{ "Edit Artwork: ".$artwork->title }} @endsection

@section("head")
    <script>
        function updatePreview() {
            if([file] = event.target.files) {
                $("#preview-image .gallery-thumbnail").attr("src", URL.createObjectURL(file));
            }
        }
    </script>
@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/artwork-editor", "title"=>"Edit artwork"],
            ["href"=>"/artwork-editor/".$artwork->id, "title"=>$artwork->title]
        ]
    ])
@endsection

@section("content")

    <div class="gallery">
        <x-gallery-art
            :href="$artwork->img_src"
            :src="$artwork->thumb_src"
            openlightbox=true
            id="preview-image"
        >
            <x-slot name="title">{{$artwork->title}}</x-slot>
            <p>{!! $artwork->description !!}</p>
        </x-gallery-art>
    </div>

    <br>
    <form action="" method="post" class="editor" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <input id="file-select" type="radio" name="fileoption" value="upload" checked onchange="$('.formtoggle').toggleClass('hidden')"><label for="file-select">File upload</label>
        <input id="url-select" type="radio" name="fileoption" value="url" onchange="$('.formtoggle').toggleClass('hidden')"><label for="url-select">Enter URL</label>
        
        <div class="formtoggle">
            <input type="file" name="image" id="image" onchange="updatePreview()">
        </div>
        <div class="formtoggle hidden">
            <input class="editor-text" type="text" id="thumb_src" name="thumb_src" value="{{ $artwork->thumb_src }}" placeholder="Thumbnail source URL" onchange="$('#preview-image').attr('src', '/'+this.value);">
            <input class="editor-text" type="text" id="img_src" name="img_src" value="{{ $artwork->img_src }}" placeholder="Image source URL">
        </div>

        <input class="editor-text" type="text" id="title" name="title" value="{{ $artwork->title }}" placeholder="Title">
        <textarea class="editor-body" id="description" name="description">{{ $artwork->description }}</textarea>

        <input class="editor-text" type="text" id="category" name="category" value="{{ $artwork->category }}" placeholder="Category tags (separated by commas)">
        <input class="editor-text" type="number" id="order" name="order" value="{{  $artwork->order }}" placeholder="Display order">
        <input type="checkbox" id="openlightbox" name="openlightbox" @if($artwork->openlightbox) checked @endif><label for="openlightbox">Open lightbox on click</label>
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