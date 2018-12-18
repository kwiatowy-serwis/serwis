<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Kwiaciarnia as KwiaciarniaAPI;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rzeszow = new KwiaciarniaAPI\Rzeszow();
        $rzeszowData = $rzeszow->pobierzDane();

        $out = [];
        foreach ($rzeszowData as $flowerDetails)
        {

//            $flowerDetails = \json_decode($flowerDetails);
            $path = public_path().'/images/flowers/%s.jpg';
            $flower = sprintf($path, $flowerDetails->name);

            if(!file_exists($flower))
            {
                continue;
            }
            $flowerDetails->flowerImage = $flower;

            $out[] = $flowerDetails;

        }

        return view('home', [
            'flowers' => $out
        ]);
    }
}
