@extends("layouts.canonical")

@section("title")
    @isset($title) {{ $title }} @endisset
@endsection

@section("content")
@yield("top")
<div class="bannergrid @unless(isset($alternate) && !$alternate) alternate @endif">
    @foreach($projects as $project)
    <x-bannerbutton class="" :project="$project"/>
    @endforeach
</div>
@endsection