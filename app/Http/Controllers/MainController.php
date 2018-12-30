<?php

namespace App\Http\Controllers;

use App\FlowerOrder;
use App\Services\DataManager;
use App\User;


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
}
