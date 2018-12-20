<?php

namespace App\Http\Controllers;

use App\Services\DataManager;
use Illuminate\Http\Request;
use App\User;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $dataManager = new DataManager();
        $flower = $dataManager->getRzeszowFlowers();

        return view('order', [
            'flowers' => $flower
        ]);

        //return view('order');


    }


}
