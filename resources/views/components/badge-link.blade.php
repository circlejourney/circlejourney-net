<a class="scriptlink" href="{{ $href }}"
    @isset($attributes["background_image"])
        style="background-image: url({{ $attributes["background_image"] }})"
    @endif>
    {{ $slot }}
</a>