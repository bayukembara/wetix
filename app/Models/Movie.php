<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function studios(){
        return $this->hasMany(Studio::class, 'id', 'movie_id');
    }
}
