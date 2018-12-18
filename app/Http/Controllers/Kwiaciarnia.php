<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Kwiaciarnia as KwiaciarniaAPI;

class Kwiaciarnia extends Controller
{

    public function flowerRze()
    {
        $rzeszow = new KwiaciarniaAPI\Rzeszow();
        $rzeszowData = $rzeszow->pobierzDane();

        dump($rzeszowData);
        die;

        return $rzeszowData;
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
