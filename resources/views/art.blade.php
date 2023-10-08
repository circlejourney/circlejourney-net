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
        @foreach($illustrations as $illustration)
            <x-gallery-art :src="$illustration->thumb_src" :href="$illustration->img_src" :openlightbox="$illustration->openlightbox">
                <h2 class="caption-title">{{ $illustration->title }}</h2>
                <p>{{ $illustration->description }}</p>
            </x-gallery-art>
        @endforeach
    </div>
@endsection