@extends("layouts.canonical")

@section("title")
    @isset($title) {{ $title }} @endisset
@endsection

@section("content")
@yield("top")
<div class="bannergrid @unless(isset($alternate) && !$alternate) alternate @endif">
    @foreach($projects as $project)
        @component("components.bannerbutton", $project->toArray()) @endcomponent
    @endforeach
</div>
@endsection