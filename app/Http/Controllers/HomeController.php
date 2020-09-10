<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('dashboard.advertiser');
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
}
