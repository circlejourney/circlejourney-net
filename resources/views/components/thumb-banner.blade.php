<div class="thumb-banner {{ $attributes["class"] }}">
    <a href="{{ $attributes["href"] }}" class="banner-thumb">
        <img src="@if($imgSrc !== '') {{ $imgSrc }} @else /images/logosmall.png @endif">
    </a>
    <div class="thumb-bannerlabel">
        {!! $slot !!}
    </div>
</div>