@extends("layouts.canonical")

@section('title'){{ "Music" }}@endsection

@section('content')
<p class="center">
    <x-badge-link href="/music/intro">
        My journey as a musician
    </x-badge-link>
    <x-badge-link href="/music/fanmusic">
        Fanmusic / invited contributions
    </x-badge-link>
</p>

<h2>Albums</h2>

<div class="badge-grid">
    @foreach($albums as $album)
    <x-badge-link :href="'/music/'.$album->slug" :background_image="$album->thumbnail_path" :alt="$album->title" />
    @endforeach
    
</div>

@endsection