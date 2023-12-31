@extends("layouts.canonical")

@section("title"){{ "Create New Artwork" }} @endsection

@push("head")
    <script>
        function updatePreview() {
            if([file] = event.target.files) {
                $("#preview-image .gallery-thumbnail").attr("src", URL.createObjectURL(file));
            }
        }
    </script>
@endpush

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
            ["href"=>"/artwork-editor", "title"=>"Edit artwork"],
            ["href"=>"/artwork-editor/create", "title"=>"Create new artwork"]
        ]
    ])
@endsection

@section("content")

    <div class="gallery">
        <x-gallery-art
            href="#"
            src="/images/logosmall.png"
            openlightbox=true
            id="preview-image"
        ></x-gallery-art>
    </div>
    
    <form action="" method="post" class="editor" enctype="multipart/form-data">
        @csrf

        <input id="file-select" type="radio" name="fileoption" value="upload" checked onchange="$('.formtoggle').toggleClass('hidden')"><label for="file-select">File upload</label>
        <input id="url-select" type="radio" name="fileoption" value="url" onchange="$('.formtoggle').toggleClass('hidden')"><label for="url-select">Enter URL</label>
        
        <div class="formtoggle">
            <input type="file" name="image" id="image" onchange="updatePreview()">
        </div>
        <div class="formtoggle hidden">
            <input class="editor-text" type="text" id="thumb_src" name="thumb_src" placeholder="Thumbnail source URL" onchange="$('#preview-image').attr('src', '/'+this.value);">
            <input class="editor-text" type="text" id="img_src" name="img_src" placeholder="Image source URL">
        </div>

        <input class="editor-text" type="text" id="title" name="title" placeholder="Title" required>
        <textarea class="editor-body" id="description" name="description" placeholder="Description"></textarea>
        
        <input class="editor-text" type="text" id="category" name="category" placeholder="Category tags (separated by commas)">
        <input class="editor-text" type="number" id="order" name="order" placeholder="Display order" value="0">
        <input type="checkbox" id="openlightbox" name="openlightbox" checked="true"><label for="openlightbox">Open lightbox on click</label>
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