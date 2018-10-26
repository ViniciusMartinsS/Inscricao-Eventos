<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function event(){
        return $this->belongsTo('App\Models\Event');
    }
}
