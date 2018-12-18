<?php

namespace App\Http\Controllers;

use App\Services\DataManager;


class MainController extends Controller
{
    public function index()
    {
        $dataManager = new DataManager();
        $flowers = $dataManager->getRzeszowFlowers();

        dump($flowers);
        die;

        return view('main', [
            'flowers' => $flowers
        ]);
    }


}
