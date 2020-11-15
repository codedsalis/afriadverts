<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Afriadverts;
use App\Models\Advert;

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

    // Start a new advert
    public function newadvert() {
        return view('advertiser.newadvert');
    }


    // Setup the advert
    public function adsetup(Request $request) {
        $intent = $request->intent;
        return view('advertiser.adsetup')->with('intent', $intent);
    }



    // Advertiser account
    public function account() {
        $Afriadverts = new Afriadverts;
        
        return view('advertiser.account')->with(['Afriadverts' => $Afriadverts]);
    }


    // View ad info and stats
    public function adinfo($id) {
        $advert = Advert::findOrFail($id);

        return view('advertiser.adinfo')->with('adinfo', $advert);
    }
}
