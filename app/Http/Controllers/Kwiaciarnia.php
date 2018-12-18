<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Kwiaciarnia as KwiaciarniaAPI;

class Kwiaciarnia extends Controller
{

    public function flowerRze()
    {

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
