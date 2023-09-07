<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\User;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable = ["title", "body", "user_id"];

    public static function prettyDate(string $date) {
        $postdate = Carbon::createFromTimestamp(strtotime( $date ));
        return $postdate->format("j M Y \\a\\t H:i:s");
    }

    public static function findCreator(string $user_id) {
        $creator = User::where("id", $user_id)->firstOrFail();
        return $creator;
    }
}
