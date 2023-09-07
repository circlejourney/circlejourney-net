@extends("layouts.canonical")

@section("title") Edit Projects @endsection

@section("content")
<ul>
    @foreach($projects as $project)
    <li><a href="/project-editor/{{ $project->item_id }}">{{ $project->label_title }}</li>
    @endforeach
</ul>
@endsection