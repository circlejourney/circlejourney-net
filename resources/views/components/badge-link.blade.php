<a
    class="scriptlink"
    href="{{ $href }}"
    style="@isset( $attributes["background_image"] ) background-image: url({{ $attributes["background_image"] }});
    @endisset
    @isset( $attributes["background_position"] ) 
        background-position: {{ $attributes["background_position"] }}
    @endisset"
    {{ $attributes }}>
    <span class="scriptlink-inside {{ $attributes["dark"] ? "dark" : "" }}">
        {{ $slot }}
    </span>
</a>