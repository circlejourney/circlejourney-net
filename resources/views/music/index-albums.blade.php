@extends("layouts.canonical")

@section('title'){{ "Create album" }}@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
        ["href"=>"/music", "title" => "Music"],
        ["href"=>"/music/album-editor", "title" => "Album editor"],
    ]])
@endsection

@section('content')
<a href="{{ route('music.album.create') }}">Create album</a>

<h2>Edit</h2>
<div class="badge-grid">
    @forelse($albums as $album)
        <x-badge-link :href="route('music.album.edit', ['album' => $album])" :background_image="$album->thumbnail_path" />
    @empty
    No albums found.
    @endforelse
</div>
@endsection