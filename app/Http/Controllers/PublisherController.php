<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Site;
use App\Models\Adunit;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
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
    public function index()
    {
        return view('publisher.sites');
    }

    /**
     * Create new site
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newsite()
    {
        return view('publisher.newsite');
    }

    /**
     * Display a particular site
     *
     * @param $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function site($id)
    {
        //Check if the user is the owner of this post
        $site = Site::findOrFail($id);

        //If true return view
        if ($site->user_id === Auth::user()->id) {
            return view('publisher.site')->with('siteId', $id);
        }

        //Return an error message otherwise
        return 'You are not allowed to view this page';
    }


    /**
     * Create a new ad unit
     *
     * @param $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newadunit($id)
    {
        //Check if the site requested exists
        $site = Site::findOrFail($id);

        //Check the number of ad units created for this site
        $adunitsInSite = Adunit::where('site_id', $id)->count();

        if ($adunitsInSite >= 3) {
            return redirect()->back()->with('error', 'You have reached the maximum number of ad units(3) allowed per site');
            // return "You have reached the maximum number of ad units(3) allowed per site";
        }

        return view('publisher.newadunit')->with('siteId', $id);
    }


    /**
     * Get an ad unit
     *
     * @param $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adunit($id)
    {
        //Check if ad unit exists
        $adUnit = Adunit::findOrFail($id);
        return view('publisher.adunit')->with('unitId', $id);
    }
}
