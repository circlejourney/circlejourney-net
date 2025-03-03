@if($title)
<div class="gallery-title">
    <h2>{{ $title }}</h2>
</div>
@endifP

<div class="gallery">
    @forelse($artworks as $artwork)
        <x-gallery-art
            :data-sequence="$artwork->openlightbox ? $lightboxable->search($artwork->id) : false"
            :openlightbox="$artwork->openlightbox"
            :href="$artwork->img_src"
            :src="$artwork->thumb_src"
            target="_blank">
            <x-slot name="title">
                {{ $artwork->title }}
            </x-slot>
            <p>{!! $artwork->description !!}</p>
        </x-gallery-art>
    @empty
        <p>None found.</p>
    @endforelse
</div>