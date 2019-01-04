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

        $orderPlaces = OrderPlace::sortable()->paginate(5);
        $flowerOrders = FLowerOrder::sortable()->paginate(5);
        return view('admin.ordersAdmin',compact('flowerOrders','orderPlaces'));

    }

    public function concreteUser($id){
        $user = User::findOrFail($id);
        $orderPlaces = OrderPlace::all();
        $flowerOrders = FLowerOrder::all();

        return view('admin.concreteUserAdmin', compact('user', 'orderPlaces', 'flowerOrders'));

    }

}
