<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BlogPost extends Model
{
    use HasFactory;
    protected $fillable = ["title", "body", "user_id"];

    public function created_pretty() {
        $postdate = Carbon::createFromTimestamp(strtotime( $this->created_at ));
        return $postdate->format("j M, Y \\a\\t H:i:s");
    }

    public function updated_pretty() {
        $postdate = Carbon::createFromTimestamp(strtotime( $this->updated_at ));
        return $postdate->format("j M, Y \\a\\t H:i:s");
    }

    public function find_creator() {    
        return User::where("id", $this->user_id)->firstOrFail();
    }

    public function edit_allowed() {
        if(!Auth::user()) return false;
        return Auth::user()->id == $this->user_id || Auth::user()->hasRank("admin");
    }
}
