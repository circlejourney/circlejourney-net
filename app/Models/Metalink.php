<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Metalink extends Model
{
    use HasFactory;
    protected $primaryKey = "item_id";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ["item_id", "href", "img_src", "title", "description", "publish_date"];
    public function publish_date_pretty() {
        return Carbon::createFromTimestamp(strtotime( $this->publish_date ))->format("j F, Y");
    }
}
