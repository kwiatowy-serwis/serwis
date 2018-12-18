<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Kwiaciarnia as KwiaciarniaAPI;

class MainController extends Controller
{
    public function index()
    {
        $rzeszow = new KwiaciarniaAPI\Rzeszow();
        $rzeszowData = $rzeszow->pobierzDane();

        $out = [];
        foreach ($rzeszowData as $flowerDetails)
        {
            $path = '/images/flowers/%s.jpg';
            $flower = sprintf(public_path().$path, $flowerDetails->name);

            if(!file_exists($flower))
            {
                continue;
            }
            $flowerDetails->flowerImage = asset(sprintf($path, $flowerDetails->name));
            $flowerDetails->name = ucfirst($flowerDetails->name);
            $out[] = $flowerDetails;

        }

        return view('main', [
            'flowers' => $out
        ]);
    }

}
