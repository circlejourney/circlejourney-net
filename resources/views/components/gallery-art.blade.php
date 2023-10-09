<div class="gallery-image">
    <a href="{{ $href }}" {{ $attributes }} target="_blank">
        <img class="thumbnail" src="{{ $src }}">
    </a>
    <div class="caption">
        {{ $slot }}
    </div>
</div>