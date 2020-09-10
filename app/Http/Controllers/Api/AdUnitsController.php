<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adunit;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AdunitResource;
use Illuminate\Support\Facades\DB;

class AdUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Lets validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'advertType' => 'required|alpha_dash',
            'siteId' => 'required|exists:sites,id',
            'userId' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 403);
        }



        //Because we are using this function for both creation and updating Adunits,
        // let's check for the type of request. If it is  a PUT we find the requested Id
        //Otherwise, we create a new resource
        $adUnit = $request->isMethod('put') ? Adunit::findOrFail($request->unit_id) : new Adunit;

        $adUnit->unit_title = strip_tags($request->title);
        $adUnit->advert_type = $request->advertType;
        $adUnit->user_id = $request->userId;
        $adUnit->site_id = $request->siteId;


        if ($adUnit->save()) {
            return new AdunitResource($adUnit);
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
        //Check if the ad unit exists or not
        $adUnit = Adunit::findOrFail($id);

        //Query for the site url together with the ad unit data
        $siteAndUnit = DB::table('ad_units')
            ->select('ad_units.*', 'sites.url')
            ->leftJoin('sites', 'ad_units.site_id', '=', 'sites.id')
            ->where('ad_units.id', '=', $id)
            ->get();

        //return a resource of the ad unit if found
        return new AdunitResource($siteAndUnit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $adUnit = Adunit::findOrFail($id);

        if ($adUnit->delete($adUnit)) {
            return new AdunitResource($adUnit);
        }
    }
}
