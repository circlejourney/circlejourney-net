<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    protected $fillable = ["title", "description", "img_src", "thumb_src", "category", "order"];
    use HasFactory;
}