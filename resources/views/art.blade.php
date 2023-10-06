@extends("layouts.projects", ["title"=>$title, "projects"=>$projects])

@section("top")
    <div class="center">
        <x-badge-link href="https://circlejourney.weebly.com">Art and design portfolio</x-badge-link>
        <x-badge-link href="https://circlejourney.carrd.co">Commission sheet</x-badge-link>
        <x-badge-link href="/commform">Slot claim form</x-badge-link>
    </div>
@endsection

@section("bottom")
    <div class="subgallery">
        <div class="gallery-title">
            <h2>Illustrations</h2>
            <div class="click-notice">Click to view full size</div>
        </div>
        @foreach($artworks as $artwork)
            <a class="gallery-image" href="{{ $artwork->img_src }}">
                <img class="thumbnail" src="{{ $artwork->thumb_src }}">
            </a>
        @endforeach
    </div>
@endsection