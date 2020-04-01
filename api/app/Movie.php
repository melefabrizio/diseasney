<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    public function ratings(){
        return $this->hasMany('App\Rating');
    }
}
