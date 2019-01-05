<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property mixed isAdmin
 */
class User extends Authenticatable
{
    use Notifiable;
    use Sortable;


    public $sortable = ['id','name', 'surname', 'email', 'isAdmin', 'created_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password','isAdmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function isAdmin(){
        return $this->isAdmin;
    }

    public function orders(){
        return $this->hasMany('App\FlowerOrder');
    }

    public function getId(){
        return $this->id;
    }


}

