@extends("layouts.canonical")

@section('title'){{ "Edit album" }}@endsection

@section("breadcrumbs")
    @include("components.breadcrumbs", ["crumbs" => [
        ["href"=> route('music.album.index'), "title" => "Album editor"],
    ]])
@endsection

@section('content')
    {{ html()->form('POST')->class('editor')->open() }}
        @include('music.form-fields', ['album' => $album])
        {{ html()->submit('Update') }}
    {{ html()->form()->close() }}
@endsection