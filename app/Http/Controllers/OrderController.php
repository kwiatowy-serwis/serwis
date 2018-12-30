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

    public function index(Request $request)
    {


        $flower = $request->request->get('flower');
        $flower = json_decode(base64_decode($flower));


        return view('order', [
            'flower' => $flower,
        ]);


    }

}
