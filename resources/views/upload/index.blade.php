@extends("layouts.canonical")

@push("head")
    <script src="/js/popup.js"></script>
    <script>
        function copyToClipboard(payload) {
            navigator.clipboard.writeText(payload);
            const copypopup = new Popup("Copied!", event.target);
            copypopup.animate();
        }
    </script>
@endpush

@section('title'){{ "Uploads" }}@endsection

@section('content')
    
    <form action="" class="editor" method="POST" enctype="multipart/form-data">
        @csrf
        <fieldset>
        <input type="file" name="file" id="file"> <label for="file">Files must be &lt; 30MB and of the following types: jpg, png, gif, tiff, pdf, txt, csv.</label>
        </fieldset>
        <button id="submit" class="editor-button">Submit</button>
    </form>
    <div class="bannergrid">
        
    @foreach($uploads as $upload)
        <div class="thumb-banner">
            @isset($upload->thumb_path)
                <div class="banner-thumb">
                    <img src="/{{ $upload->thumb_path }}">
                </div>
            @endisset
            
            <div class="thumb-bannerlabel" style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
                <div>
                    <a href="/{{ $upload->file_path }}">
                        {{ $upload->file_path }}
                    </a>
                    <button class="relative" onclick="copyToClipboard(location.origin+'/{{$upload->file_path}}')">Copy</button>
                </div>

                <form action="/upload/delete/{{ $upload->id }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button id="delete" name="delete" value="{{$upload->id}}">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
    
    </div>
@endsection