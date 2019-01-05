<?php

namespace App\Http\Controllers;

use App\FlowerOrder;
use App\OrderPlace;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    public function showUsers()
    {
        $users = User::sortable()->paginate(5);
        return view('admin.usersAdmin', compact('users'));

    }

    public function showOrders(){

        $flowerOrders = FLowerOrder::sortable()->paginate(5);

        return view('admin.ordersAdmin',compact('flowerOrders'));

    }

    public function concreteUser($id){
        $user = User::findOrFail($id);
        $flowerOrders = FLowerOrder::where('user_id','=', $user->id)->sortable('user_id')->paginate(10);

        return view('admin.concreteUserAdmin', compact('user','flowerOrders'));

    }

}
