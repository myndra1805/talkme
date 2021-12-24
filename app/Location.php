<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ["user_id", "lang", "lat"];

    public function user(){
        $this->belongsTo("App\User");
    }

}
