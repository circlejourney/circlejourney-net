<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categorisable extends Model
{
    use HasFactory;
    public function categories() : BelongsToMany {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function getCategoryStringAttribute() {
        return $this->categories()->pluck("name")->join(",");
    }

    public function updateCategories(array $categories) {
        $remove = $this->categories()->pluck("name")->diff(collect($categories));
        $add = collect($categories)->diff($this->categories()->pluck("name"));

        foreach($add as $category_name) {
            if(!$category = Category::where("name", $category_name)->first()) {
                $category = Category::create([
                    "name" => $category_name
                ]);
            }
            $this->categories()->syncWithoutDetaching($category->id);
        }
        $detachable = Category::whereIn("name", $remove);
        $this->categories()->detach($detachable->pluck("id"));
        foreach($detachable->get() as $category) {
            error_log($category);
            if(!$category->artworks()->count() && !$category->projects()->count()) $category->delete();
        }
    }
}
