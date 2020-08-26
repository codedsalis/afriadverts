<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Site;
use Auth;

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
    public function index() {
        // return view('publisher.dashboard');
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
            if($site->user_id === Auth::user()->id) {
                return view('publisher.site')->with('siteId', $id);
            }

            //Return an error message otherwise
            return 'You are not allowed to view this page';
    }

}
