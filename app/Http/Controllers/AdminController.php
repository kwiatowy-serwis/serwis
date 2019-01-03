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
        $users = User::all();

        return view('admin.usersAdmin', [
            'users' => $users,
        ]);
    }

    public function showOrders(){


        $flowerOrders = FlowerOrder::all();
        $orderPlaces = OrderPlace::all();

        return view('admin.ordersAdmin',[
           'flowerOrders' => $flowerOrders,
            'orderPlaces' => $orderPlaces,
        ]);

    }

}
