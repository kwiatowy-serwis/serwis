<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPlace extends Model
{
    public function user()
    {
        return $this->belongsTo('App\FlowerOrder');
    }
}
