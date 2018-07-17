<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regisseur extends Model
{
    protected $fillable = [
        'forename', 'lastname', 'birthyear'
    ];

    public function movies()
    {
        return $this->hasMany('App\Movie');
    }
}
