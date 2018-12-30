<?php

namespace App\Http\Controllers;

use App\Services\DataManager;
use App\Services\Kwiaciarnia\Rzeszow;
use Illuminate\Http\Request;
use App\User;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $flower = $request->request->get('flower');
        $flower = json_decode(base64_decode($flower));

        $flower->serialized=$request->request->get('flower');

        return view('order', [
            'flower' => $flower,
        ]);
    }

    public function order(Request $request)
    {
        $flower = $request->request->get('flower');
        $flower = json_decode(base64_decode($flower));

        $data= new \stdClass();

        $data->quantity = $request->request->get('flowerQuantity');

        return view('orderForm', [
            'flower' => $flower,
            'data' => $data,
        ]);


    }

    public function makeOrder($flower)
    {
        $kwiaciarnia = new Rzeszow();
        $res = $kwiaciarnia->makeOrder($flower->id, 5);



    }


}
