<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function movies()
    {
        return $this->belongsTo('App\Movie');
    }
}
