<?php

namespace App\Http\Controllers;

use App\FlowerOrder;
use App\OrderPlace;
use App\Services\DataManager;
use App\Services\Kwiaciarnia\Rzeszow;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

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

        $input = new OrderPlace;
        $input->firstname = $request->firstname;
        $input->lastname = $request->lastname;
        $input->phone = $request->phone;
        $input->city = $request->city;
        $input->street = $request->street;
        $input->zip_code = $request->zip_code;
        $input->houseNumber = $request->houseNumber;

        $input->save();

        $inputOrders = new FlowerOrder;
        $inputOrders->florist_company = $input->city;
        $inputOrders->courier_company = "GlobalUser";
        $inputOrders->order_place_id = $input->id;
        $inputOrders->user_id = Auth::user()->id;


        $inputOrders->save();

        $kwiaciarnia = new Rzeszow();
        $res = $kwiaciarnia->makeOrder(1, 5);

        return redirect()->route('home');
    }


}
