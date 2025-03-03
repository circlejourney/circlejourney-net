<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Metalink extends Categorisable
{
    use HasFactory;
    protected $primaryKey = "item_id";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ["item_id", "href", "img_src", "title", "category", "description", "publish_date", "track_number"];
    public function publish_date_pretty() {
        return Carbon::createFromTimestamp(strtotime( $this->publish_date ))->format("j F, Y");
    }
}
