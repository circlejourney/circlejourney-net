@extends("layouts.projects", ["title"=>$title, "projects"=>$projects])

@section("top")
    @include("components.lightbox")
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
            <x-gallery-art :src="$artwork->img_src" :href="$artwork->thumb_src">
                <p>{{ $artwork->title }}</p>
                {{ $artwork->description }}
            </x-gallery-art>
        @endforeach
    </div>
@endsection