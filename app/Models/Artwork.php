<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artwork extends Categorisable
{
    protected $fillable = ["title", "description", "img_src", "thumb_src", "category", "order", "openlightbox"];
    use HasFactory;
}