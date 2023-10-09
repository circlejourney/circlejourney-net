<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artwork;

class ArtworkCleanupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artworks = Artwork::where('img_src', "like", "/%")->orWhere('thumb_src', "/%")
            ->get();

        foreach($artworks as $item) {
            $item->update([
                "img_src" => preg_replace( "/^\//", "", $item["img_src"] ),
                "thumb_src" => preg_replace( "/^\//", "", $item["thumb_src"] )
            ]);
        }
    }
}
