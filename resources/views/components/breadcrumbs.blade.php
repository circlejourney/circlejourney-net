<div class="breadcrumbs">
    <a href="/">Home</a>
    @foreach($crumbs as $crumb)
        &#x1F892; <a href="{{ $crumb["href"] }}">{{ $crumb["title"] }}</a>
    @endforeach
</div>