@if ($title)
<div class="gallery-title">
    <h2>{{ $title }}</h2>
</div>
@endif

<div class="gallery">
    @forelse($artworks as $artwork)
        <x-gallery-art
            :data-sequence="$artwork->openlightbox ? $lightboxable->search($artwork->id) : false"
            :openlightbox="$artwork->openlightbox"
            :href="$artwork->img_src.'?'.$artwork->updated_at->timestamp"
            :src="$artwork->thumb_src.'?'.$artwork->updated_at->timestamp"
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