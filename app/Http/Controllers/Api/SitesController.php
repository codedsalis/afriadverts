<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Http\Resources\Site as SiteResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Return all the sites in the database with a simple pagination
        // return DB::table('sites')->simplePaginate(20);
        return SiteResource::collection(Site::paginate(20));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
            'category' => 'required|alpha_dash',
            'userId' => 'required|exists:users,id'
        ]);

        if($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 403);
        }


        //Get site id for update if it is a PUT request or create new one if it is a POST request
        $site = $request->isMethod('put') ? Site::findOrFail($request->site_id) : new Site;

        // if ($validator->fails()) {

        // //pass validator errors as errors object for ajax response

        // return response()->json(['errors'=>$validator->errors()]);
        // }

        $site->url = $request->input('url');
        $site->category = $request->input('category');
        $site->user_id = $request->input('userId');
        $site->pub_key = 'site-' . \md5($site->url);
        $site->verification_code = '<meta name="afri_verification" content="' . $site->pub_key . '"/><script src="https://static.afriadverts.com/js/pubvfpv.js"></script><script>window.onload = function(){var url = ' . $request->url . ';var pid = ' . $request->input('userId') . ';var key = ' . $site->pub_key . ';return renderPageViews({url: url,pid: pid,key: key});};</script>';

        if($site->save()) {
            return new SiteResource($site);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get a particular site by it's ID
        $site = Site::findOrFail($id);

        //return a resource of the Site
        return new SiteResource($site);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Get the site Id
        $site = Site::findOrFail($id);

        if($site->delete()) {
            return new SiteResource($site);
        }
    }


    /**
     * Get all sites created by a particular user with the different given conditions
     * 
     * @param int $id
     * @param \Request $request
     * @return \Illuminate\Http\Response
     */
    public function usersites($id, Request $request)
    {
        //
        if($request->_intent === 'paginate') {
            $sites = DB::table('sites')
                        ->select('*')
                        ->where('user_id', '=', $id)
                        ->paginate(15);
        } elseif($request->_intent === 'limit') {
            //For getting the limit value, hence the take query must accompany the _intent=limit query
            //ie ?_intent=limit&take=7

            //Let's test for the availability for the take query string
            //If it's not found, we return an error message
            if(! $request->has('take')) {
                return response()->json([
                    'error' => 1,
                    'message' => 'Bad request!'
                ], 400);
            }
            $take = $request->take;
            
            //Get the sites limited as requested
            $sites = DB::table('sites')
                            ->select('*')
                            ->where('user_id', '=', $id)
                            ->limit($take)->get();
        } elseif($request->_intent === 'count') {
            //If the intent is 'count' then we return the total counted rows
            $count = DB::table('sites')
                            ->select('*')
                            ->where('user_id', '=', $id)
                            ->count();
            return response()->json([
                'total' => $count,
            ], 200);
        } else {
            //If no condition is specified, return all the sites
            $sites = DB::table('sites')
                            ->select('*')
                            ->where('user_id', '=', $id)
                            ->get();
        }

        //Return a resource of user sites
        return new SiteResource($sites);
    }
}
