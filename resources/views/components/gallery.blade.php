@push('head')
    @include("components.lightbox-scripts")
@endpush

@include("components.lightbox", ["artworks" => $lightboxable])

<div class="gallery">
    @foreach($artworks as $artwork)
        <x-gallery-art
            :data-sequence="$artwork->openlightbox ? $sequence++ : false"
            :openlightbox="$artwork->openlightbox"
            :href="$artwork->img_src"
            :src="$artwork->thumb_src"
            target="_blank">
            <x-slot name="title">
                {{ $artwork->title }}
            </x-slot>
            <p>{!! $artwork->description !!}</p>
        </x-gallery-art>
    @endforeach
</div>