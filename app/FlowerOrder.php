<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowerOrder extends Model
{
    //

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderPlace()
    {
        return $this->belongsTo('App\OrderPlace');
    }
}
