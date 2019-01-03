<?php

namespace App\Http\Controllers;

use App\FlowerOrder;
use App\Services\DataManager;
use App\User;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function index(Request $request)
    {
        try{
        $dataManager = new DataManager();
        $flowers_rz = $dataManager->getRzeszowFlowers();

        $flowers_kr = $dataManager->getKrakowFlowers();


        $cityChoice = $request->request->get('cityName');


        if($cityChoice == "Kraków") {
            return view('main-krakow', [
                'flowers_kr' => $flowers_kr,
                'cityChoice' => $cityChoice,
            ]);

        }else{

            return view('main', [
                'flowers_rz' => $flowers_rz,
                'cityChoice' => $cityChoice,
            ]);

        }
        }catch(\Exception $e){
            return view('layouts.apiRefuse');
        }
    }
}
