<a class="gallery-image" href="{{ $href }}" @isset($attributes["openlightbox"]) onclick="event.preventDefault(); openLightbox('{{ $href }}')" @endisset>
    <img class="thumbnail" src="{{ $src }}">
    <div class="caption">
        <p>{{ $slot }}</p>
    </div>
</a>