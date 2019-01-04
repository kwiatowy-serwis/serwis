<?php

namespace App\Http\Controllers;


use App\FlowerOrder;
use App\OrderPlace;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth()->user();
        $orderPlaces = OrderPlace::sortable()->paginate(5);
        $flowerOrders = FLowerOrder::where('user_id','=', $user->id)->sortable()->paginate(5);
        $i = 1;

        return view('home', [
            'user' => $user,
            'orderPlaces' => $orderPlaces,
            'flowerOrders' => $flowerOrders,
            'i' => $i,
        ]);
    }

}
