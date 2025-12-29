@extends("layouts.canonical")

@section('title'){{ "Create album" }}@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
        ["href"=>"/music", "title" => "Music"],
        ["href"=>"/music/album-editor", "title" => "Album editor"],
    ]])
@endsection

@section('content')
    {{ html()->form('POST')->class('editor')->open() }}
        @include('music.form-fields', ['album' => null])
        {{ html()->submit('Create')->class('editor-button') }}
    {{ html()->form()->close() }}
@endsection