<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Advert;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.overview');
    }


    /**
     * Show the publisher dashboard
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function publisher()
    {
        return view('dashboard.publisher');
    }


    /**
     * Show the publisher dashboard
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function advertiser()
    {
        // Get the number of adverts a user has created
        $adsCount = Advert::where('user_id', Auth::user()->id)->count();
        return view('dashboard.advertiser')->with('adsCount', $adsCount);
    }


    /**
     * User settings page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings()
    {
        return view('dashboard.settings');
    }


    /**
     * Notifications page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function notifications()
    {
        return view('dashboard.notifications');
    }
}
