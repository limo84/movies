<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'part', 'subtitle'
    ];

    public function regisseur()
    {
        return $this->belongsTo('App\Regisseur');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function avgRating(){
        return $this->ratings()->avg('stars');
    }
}
