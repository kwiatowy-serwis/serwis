<?php

namespace App\Http\Controllers;

use App\Services\DataManager;


class MainController extends Controller
{
    public function index()
    {

        $dataManager = new DataManager();
        $flowers = $dataManager->getRzeszowFlowers();

        return view('main', [
            'flowers' => $flowers
        ]);
    }

    public function orderFlower(){


    }


}
