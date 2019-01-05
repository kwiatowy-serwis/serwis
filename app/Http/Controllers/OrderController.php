<?php

namespace App\Http\Controllers;

use App\FlowerOrder;
use App\OrderPlace;
use App\Services\DataManager;
use App\Services\Kurier\GlobalKurier;
use App\Services\Kwiaciarnia\Krakow;
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

        $flowerId = $request->request->get('flowerId');
        $flowerQuantity = $request->request->get('flowerQuantity');
        $flowerName = $request->request->get('flowerName');
        $PriceForFlower = $request->request->get('PriceForFlower');

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
        $inputOrders->ware = $flowerName;
        $inputOrders->price = $PriceForFlower;
        $inputOrders->quantity = $flowerQuantity;
        $inputOrders->florist_company = $input->city;
        $inputOrders->courier_company = "GlobalKurier";
        $inputOrders->order_place_id = $input->id;
        $inputOrders->user_id = Auth::user()->id;


        $inputOrders->save();


        if(!$request->test)
        {
            if($input->city == "rzeszow") {
                $kwiaciarnia_rz = new Rzeszow();
                $res = $kwiaciarnia_rz->makeOrder($flowerId, $flowerQuantity);
            }else {
                $kwiaciarnia_rz = new Krakow();
                $res = $kwiaciarnia_rz->makeOrder($flowerId, $flowerQuantity);
            }


            $receptionPlace = $kwiaciarnia_rz->getCompanyAddress();
            $receptionPlace = (array) $receptionPlace;

            $deliverPlace = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'city' => $request->city,
                'street' => $request->street,
                'zip_code' => $request->zip_code,
                'phone' =>  $request->phone,
            ];

            $kurier = new GlobalKurier();
            $res = $kurier->makeOrder($this->takeCourier(), $receptionPlace, $deliverPlace);
        }

        return redirect('home');
    }


    public function takeCourier(){

        $kurier = new GlobalKurier();

        $randomKurier = $kurier->pobierzKurierow();
        $courier = "";
        foreach($randomKurier as $key => $kurierzy){
            if($kurierzy->free == 1){
                $courier = $kurierzy->id;
                return $courier;
            }
        }

        return false;
    }

}
