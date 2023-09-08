@extends("layouts.canonical")

@section('title')
    {{ $user->name }}'s profile
@endsection

@section('content')
    <div class="center" style="width: 100%;">
        <p>
            Joined {{ $user->joined_pretty() }}
        </p>
        
        @if($user->bio)
            <h2>Short bio</h2>
            <p>
                {{ $user->bio }}
            </p>
        @endif
        
        <h2>Blog posts</h2>
        @forelse($posts as $post)
            <p><a href="/blog/{{ $post->id }}/">{{ $post->title }}</a></p>
            <?php
            ?>
            <p>{{ strlen($post->body) < 50 ? $post->body : (substr($post->body, 0, 50) . "...") }}</p>
        @empty
            <p>This user hasn't made any blog posts yet.</p>
        @endforelse
    </div>
@endsection