<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class OrderPlace extends Model
{

    use Sortable;


    public $sortable = ['id','firstname', 'lastname', 'phone', 'city', 'street', 'zip_code', 'houseNumber', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\FlowerOrder');
    }
}
