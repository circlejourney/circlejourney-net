<?php
    use App\Models\Project;
?>

@extends("layouts.canonical")

@section("title") @yield("title") @endsection

@section("content")
@yield("top")
<div class="bannergrid">
    @foreach($projects as $project_id)
        <?php $project = Project::where("item_id", $project_id)->firstOrFail(); ?>
        @component("components.bannerbutton",
            $project->toArray()
        ) @endcomponent
    @endforeach
</div>
@endsection