<a class="gallery-image" href="{{ $href }}" @if($attributes["openlightbox"]) onclick="event.preventDefault(); openLightbox('{{ $href }}')" @endif>
    <img class="thumbnail" src="{{ $src }}">
    <div class="caption">
        <p>{{ $slot }}</p>
    </div>
</a>