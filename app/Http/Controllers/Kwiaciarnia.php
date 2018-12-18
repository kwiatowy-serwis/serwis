<?php

namespace App\Http\Controllers;

use App\Services\DataManager;
use Illuminate\Http\Request;
use App\Services\Kwiaciarnia as KwiaciarniaAPI;

class Kwiaciarnia extends Controller
{

    public function flowerRze()
    {
        $dataManager = new DataManager();
        $flowers = $dataManager->getRzeszowFlowers();

        dump($flowers);
        die;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
