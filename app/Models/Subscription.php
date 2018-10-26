<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function activity(){
        return $this->belongsTo('App\Models\Activity');
    }

    public function user(){
        return $this->belongsTo('App\Model\User');
    }
}
