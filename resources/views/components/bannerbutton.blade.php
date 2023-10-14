<a
    href="{{ $href }}"
    class="bannerbutton {{ $attributes["class"] }}"
    style="background-image: url({{ $background_image }}); background-position: {{ $background_position }};"
    {{ $attributes }}>

    <div class="bannerlabel @if($dark) darker @endif">
        <h2>{{$label_title}}</h2>
        {!! $label_text !!}
    </div>

</a>