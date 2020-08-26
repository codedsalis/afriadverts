<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertiserController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        //Provide access for only authenticated users
        $this->middleware('auth');
    }


    //Dashboard
    public function index() {
        return view('dashboard.advertiser');
    }
}
