<a
    href="{{ $href }}"
    class="bannerbutton {{ $attributes["class"] }}"
    style="background-image: url({{ $background_image }}); background-position: {{ $background_position }};"
    target="_blank">

    <div class="bannerlabel @if($dark) dark @endif">
        <h2>{{$label_title}}</h2>
        {!! $label_text !!}
    </div>

</a>