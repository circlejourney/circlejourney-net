<a class="gallery-image"
    data-sequence="{{ $attributes["sequence"] }}"
    href="{{ $href }}"
    @if($attributes["openlightbox"])@endif>
    <img class="thumbnail" src="{{ $src }}">
    <div class="caption">
        <p>{{ $slot }}</p>
    </div>
</a>