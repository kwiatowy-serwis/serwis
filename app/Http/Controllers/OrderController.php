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
        if(!$flower )
        {
            return redirect('/');
        }
        $flower = json_decode(base64_decode($flower));

        $flower->serialized=$request->request->get('flower');

        return view('order', [
            'flower' => $flower,
        ]);
    }

    public function order(Request $request)
    {

        $flowerQuery   = $request->request->get('flower');
        $quantity      = $request->request->get('flowerQuantity');

        $flower = json_decode(base64_decode($flowerQuery));

        if(!$flower || !$quantity || $quantity > $flower->quantity)
        {
            return redirect('/');
        }

        $data= new \stdClass();
        $data->quantity = $quantity;

        $dataManager = new DataManager();
        $couriers = $dataManager->getCouriers();

        return view('orderForm', [
            'flower' => $flower,
            'data' => $data,
            'couriers' => $couriers,
        ]);

    }

    public function makeOrder(Request $request)
    {
        //TODO
        // dodac do bazy
        // posałc do kwiaciarni
        // poslac do kuruerów



//        $kwiaciarnia = new Rzeszow();
//        $res = $kwiaciarnia->makeOrder($flower->id, 5);


        //redirect

        // returr view('orderComplete');

    }


}
