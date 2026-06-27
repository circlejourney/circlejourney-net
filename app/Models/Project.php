<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Categorisable
{
    use HasFactory;
    protected $fillable = ["item_id", "href", "background_image", "background_position", "label_title", "label_text", "dark", "category", "order"];

    public static function inCategory( string $category ) {
        $category = Category::where('name', $category)->first();
        return $category? $category->projects()->orderBy("order") : self::where('id', false);
    }
}
