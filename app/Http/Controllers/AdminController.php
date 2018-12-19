<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');



//        if(auth()->user()->isAdmin != 1)
//        {
//            return redirect()->action('HomeController@index');
//
//        }

    }

    private function redirect()
    {
        return redirect()->action('HomeController@index');
    }


    private function isAdmin()
    {
        if(auth()->user()->isAdmin == 1)
        {
            return true;
        }

        return false;
    }


    public function index()
    {
        if(!$this->isAdmin())
        {
            return $this->redirect();
        }

        return view('admin.index');
    }
}
