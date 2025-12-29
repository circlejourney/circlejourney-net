<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $albums = json_decode( file_get_contents( resource_path('seeders/albums.json') ), true );
        $count = count($albums);
        DB::beginTransaction();
        foreach($albums as $i => $albumData) {
            if(!$album = Album::where('slug', $albumData['slug'])->first()) {
                $album = new Album;
                $album->description = "";
            }
            $album->fill( $albumData + ['order' => $count - $i] );
            $album->save();
        }
        DB::commit();
    }
}
