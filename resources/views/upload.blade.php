@extends("layouts.canonical")

@section("title"){{ "Upload a file" }}@endsection

@section("content")
    @isset($message)
        <div class="alert">{!! $message !!}</div>
    @endisset
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button id="submit">Submit</button>
    </form>
@endsection