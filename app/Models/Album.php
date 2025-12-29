<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'thumbnail_path', 'description', 'bandcamp_id', 'bandcamp_slug', 'spotify_id', 'youtube_id'];

    public function getRouteKeyName() { return 'slug'; }
}
