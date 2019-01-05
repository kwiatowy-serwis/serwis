<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class FlowerOrder extends Model
{
    use Sortable;


    public $sortable = ['id','user_id', 'order_place', 'ware', 'quantity', 'price', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User')->first();
    }

    public function orderPlace()
    {
        return $this->belongsTo('App\OrderPlace')->first();
    }
}
