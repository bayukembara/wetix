<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $table = 'studios';

    public function movies(){
        return $this->belongsTo('App\Models\Movie', 'movie_id', 'id');
    }
}
