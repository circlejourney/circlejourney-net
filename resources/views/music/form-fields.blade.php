        {{ html()->label('Title', 'title') }}
        {{ html()->text('title', $album?->title)->class('editor-text') }}
        {{ html()->label('Slug (path on this website)', 'slug') }}
        {{ html()->text('slug', $album?->slug)->class('editor-text') }}
        {{ html()->label('Thumbnail', 'thumbnail_path') }}
        {{ html()->text('thumbnail_path', $album?->thumbnail_path)->class('editor-text') }}
        {{ html()->label('Description', 'description') }}
        {{ html()->textarea('description', $album?->description)->class('editor-body') }}
        
        {{ html()->label('Bandcamp ID (/EmbeddedPlayer/album={id})', 'bandcamp_id') }}
        {{ html()->text('bandcamp_id', $album?->bandcamp_id)->class('editor-text') }}
        {{ html()->label('Bandcamp slug (/album/{slug}', 'bandcamp_slug') }}
        {{ html()->text('bandcamp_slug', $album?->bandcamp_slug)->class('editor-text') }}
        
        {{ html()->label('Spotify ID (/embed/album/{id})', 'spotify_id') }}
        {{ html()->text('spotify_id', $album?->spotify_id)->class('editor-text') }}

        {{ html()->label('YouTube ID (/playlist/?list={id})', 'youtube_id') }}
        {{ html()->text('youtube_id', $album?->youtube_id)->class('editor-text') }}