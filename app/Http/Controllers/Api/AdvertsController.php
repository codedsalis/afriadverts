<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AdvertResource;
use App\Http\Resources\AdvertsStatistic;
use App\Models\Advert;
use App\User;
use App\Library\Afriadverts;

class AdvertsController extends Controller
{
    /**
     * Create a new advert
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function adsetup(Request $request) {

        // Lets validate the request
        $validator = Validator::make($request->all(), [
            'advert_intent' => [
                'required',
                Rule::in(['website', 'phone', 'whatsapp']),
            ],
            'format' => [
                'required',
                Rule::in(['image', 'carousel', 'responsive']),
            ],
            'user_id' => 'required|exists:users,id',
            'title' => [
                'required','string',
            Rule::notIn(["undefined"]),
            ],
            'url' => [
                'required',
                Rule::notIn(["undefined"]),
            ],
            'subtext' => [
                'required',
                Rule::notIn(["undefined"]),
            ],
            'action_btn' => 'required',
            'description' => [
                'required','string','max:100',
                Rule::notIn(["undefined"]),
            ],
            'country' => 'required|string',
            'platforms' => 'required|string',
            'categories' => 'required|string',
            'keywords' => [
                'required','string',
                Rule::notIn(["undefined"]),
            ],
            'daily_budget' => 'required|gte:100|digits_between:3,7',
            'total_budget' => 'required|gte:500|digits_between:3,8',
            'cpc' => 'required|gte:10|digits_between:2,5',
            'duration' => 'required',
            'files' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 403);
        }
        else {
            if($request->hasFile('files')) {
    
                // If the files uploaded are more than 5 it should be rejected
                if(count($request->file('files')) > 5) {
                    return \response()->json([
                        "files" => "You cannot upload more than 5 banners for your advert"
                    ], 403);
                }
                
                // Advert token
                $tokenStrings = Afriadverts::randomStrings(100);

                // use a shorten form of the token for the directory
                //  to store images for the particular advert
                $path = substr($tokenStrings, 0, 25);

                // Iniatialize for storing the files as array
                $data = "";
                
                // Iterate through the file request and extract each one after the other
                foreach($request->file('files') as $file) {

                    // Get individual file extension
                    $fileExtension = $file->getClientOriginalExtension();
                    
                    // These are the only allowed image types
                    $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
    
                    // if the files exxtensions are valid, upload
                    if(in_array($fileExtension, $allowedExtensions)) {
                        $fileName = Afriadverts::randomStrings(45) . '.' . $file->extension();

                        //Create the directory if it doesnt exist
                        if(!is_dir(storage_path('app/banners/' . $path))) {
                            mkdir(storage_path('app/banners/' . $path));
                        }
                        
                        // Store the files
                        $file->storeAs('banners/' . $path, $fileName);
                        $data .= $fileName . ',';
                    }
                }
                
                $advert = new Advert;

                $advert->user_id = $request->input('user_id');
                $advert->advert_type = $request->input('advert_intent');
                $advert->ad_format = $request->input('format');
                $advert->ad_title = $request->input('title');
                $advert->ad_url = $request->input('url');
                $advert->sub_text = $request->input('subtext');
                $advert->action_button = $request->input('action_btn');
                $advert->ad_description = $request->input('description');
                $advert->target_countries = $request->input('country');
                $advert->target_keywords = $request->input('keywords');
                $advert->target_os = $request->input('platforms');
                $advert->target_categories = $request->input('categories');
                $advert->advert_token = $tokenStrings;
                $advert->daily_budget = ((integer)$request->input('daily_budget')*100); // Convert from Naira to Kobo
                $advert->ad_budget = ((integer)$request->input('total_budget')*100); // Convert from Naira to Kobo
                $advert->ad_cpc = ((integer)$request->input('cpc')*100); // Convert from Naira to Kobo
                $advert->duration = $request->input('duration');
                $advert->ad_images = $data;
    
    
                if($advert->save()) {
                    return new AdvertResource($advert);
                }
            }
            
        }

    }

    
    /**
     * Get advert statistics in days
     * 
     * @param int $id
     * @param int Request $request
     * @return App\Http\Resources\AdvertsStatistic
     */
    public function adstatistics(int $id, Request $request) {
        $advert = DB::table('adverts')->find($id);


        if($advert->user_id != $request->user_id) {
            return response()->json([
                "error" => "Unauthorised user access denied"
            ], 403);
        }

        $previousMonth = date('Y-m-d', strtotime('first day of last month'));
        $pastOneMonth = date('Y-m-d', strtotime('-1 months'));
        $thisMonth = date('Y-m-d', strtotime('first day of this month'));
        $pastOneWeek = date('Y-m-d', strtotime('-1 weeks'));
        $pastFiveDays = date('Y-m-d', strtotime('-5 days'));
        $yesterday = date('Y-m-d', strtotime('yesterday'));
        $today = date('Y-m-d', strtotime('today'));

        switch($request->ranges) {
            case 'all-time':
                $stats = DB::table('adverts_statistics')
                            ->select('id','day','clicks_counter','impressions_counter')
                            ->where('advert_id', $id)
                            ->where('user_id', $advert->user_id)
                            ->orderBy('day', 'asc')
                            ->get();
            break;
            case 'past-one-week':
                $stats = DB::table('adverts_statistics')
                            ->select('id','day','clicks_counter','impressions_counter')
                            ->where('advert_id', $id)
                            ->where('user_id', $advert->user_id)
                            ->where('day', '>=', $pastOneWeek)
                            ->orderBy('day', 'asc')
                            ->get();
            break;
            case 'past-one-month':
                $stats = DB::table('adverts_statistics')
                            ->select('id','day','clicks_counter','impressions_counter')
                            ->where('advert_id', $id)
                            ->where('user_id', $advert->user_id)
                            ->where('day', '>=', $pastOneMonth)
                            ->orderBy('day', 'asc')
                            ->get();
            break;
            case 'previous-month':
                $stats = DB::table('adverts_statistics')
                            ->select('id','day','clicks_counter','impressions_counter')
                            ->where('advert_id', $id)
                            ->where('user_id', $advert->user_id)
                            ->where('day', '>=', $previousMonth)
                            ->where('day', '<', $thisMonth)
                            ->orderBy('day', 'asc')
                            ->get();
            break;
            case 'this-month':
                $stats = DB::table('adverts_statistics')
                            ->select('id','day','clicks_counter','impressions_counter')
                            ->where('advert_id', $id)
                            ->where('user_id', $advert->user_id)
                            ->where('day', '>=', $thisMonth)
                            ->orderBy('day', 'asc')
                            ->get();
            break;
            case 'past-five-days':
                $stats = DB::table('adverts_statistics')
                            ->select('id','day','clicks_counter','impressions_counter')
                            ->where('advert_id', $id)
                            ->where('user_id', $advert->user_id)
                            ->where('day', '>=', $pastFiveDays)
                            ->orderBy('day', 'asc')
                            ->get();
            break;
            case 'yesterday':
                $stats = DB::table('adverts_statistics')
                            ->select('id','day','clicks_counter','impressions_counter')
                            ->where('advert_id', $id)
                            ->where('user_id', $advert->user_id)
                            ->where('day', '>=', $yesterday)
                            ->where('day', '<', $today)
                            ->orderBy('day', 'asc')
                            ->get();
            break;
            case 'today':
            default:
            $stats = DB::table('adverts_statistics')
                            ->select('id','day','clicks_counter','impressions_counter')
                            ->where('advert_id', $id)
                            ->where('user_id', $advert->user_id)
                            ->where('day', '>=', $today)
                            ->orderBy('day', 'asc')
                            ->get();
            break;

        }

        return new AdvertsStatistic($stats);
    }

    public function update(Request $request) {
        // Lets validate the request
        if($request->portion == "basic") {
            $validator = Validator::make($request->all(), [
                'advert_intent' => [
                    'required',
                    Rule::in(['website', 'phone', 'whatsapp']),
                ],
                'format' => [
                    'required',
                    Rule::in(['image', 'carousel', 'responsive']),
                ],
                'user_id' => 'required|exists:users,id',
                'advert_id' => 'required|exists:adverts,id',
            ]);
        }
        elseif($request->portion == "configuration") {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'advert_id' => 'required|exists:adverts,id',
                'title' => [
                    'required','string',
                Rule::notIn(["undefined"]),
                ],
                'url' => [
                    'required',
                    Rule::notIn(["undefined"]),
                ],
                'subtext' => [
                    'required',
                    Rule::notIn(["undefined"]),
                ],
                'action_btn' => 'required',
                'description' => [
                    'required','string','max:100',
                    Rule::notIn(["undefined"]),
                ],
            ]);
        }
        elseif($request->portion == "targeting") {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'advert_id' => 'required|exists:adverts,id',
                'country' => 'required',
                'platforms' => 'required',
                'categories' => 'required',
                'keywords' => [
                    'required','string',
                    Rule::notIn(["undefined"]),
                ],
            ]);
        }
        elseif($request->portion == "budget") {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'advert_id' => 'required|exists:adverts,id',
                'daily_budget' => 'required|gte:100|digits_between:3,7',
                'total_budget' => 'required|gte:500|digits_between:3,8',
                'cpc' => 'required|gte:10|digits_between:2,5',
                'duration' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 403);
        }

        $advert = Advert::findOrFail($request->advert_id);

        switch($request->portion) {
            case 'basic':
                $advert->advert_type = $request->input('advert_intent');
                $advert->ad_format = $request->input('format');
            break;
            case 'configuration':
                $advert->ad_title = $request->input('title');
                $advert->ad_url = $request->input('url');
                $advert->sub_text = $request->input('subtext');
                $advert->action_button = $request->input('action_btn');
                $advert->ad_description = $request->input('description');
            break;
            case 'targeting':
                $advert->target_countries = implode(",",$request->country);
                $advert->target_keywords = $request->input('keywords');
                $advert->target_os = implode(",", $request->platforms);
                $advert->target_categories = implode(",", $request->categories);
            break;
            case 'budget':
                $advert->daily_budget = ((integer)$request->input('daily_budget')*100); // Convert from Naira to Kobo
                $advert->ad_budget = ((integer)$request->input('total_budget')*100); // Convert from Naira to Kobo
                $advert->ad_cpc = ((integer)$request->input('cpc')*100); // Convert from Naira to Kobo
                $advert->duration = $request->input('duration');
            break;
            default:
        break;
        }
        if($advert->save()) {
            return new AdvertResource($advert);
        }
    }


    public function updateImages(Request $request) {
        $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'advert_id' => 'required|exists:adverts,id',
                'files' => 'required',
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    $validator->errors()
                ], 403);
            }
    
            $advert = Advert::findOrFail($request->advert_id);

                if($request->hasFile('files')) {
    
                    // If the files uploaded are more than 5 it should be rejected
                    if(count($request->file('files')) > 5) {
                        return \response()->json([
                            "files" => "You cannot upload more than 5 banners for your advert"
                        ], 403);
                    }
                    
                    $tokenStrings = $advert->advert_token;

                    // get the token for to store images for the particular advert
                    $path = substr($tokenStrings, 0, 25);
    
                    // Iniatialize for storing the files as array
                    $data = "";
                    
                    // Iterate through the file request and extract each one after the other
                    foreach($request->file('files') as $file) {
    
                        // Get individual file extension
                        $fileExtension = $file->getClientOriginalExtension();
                        
                        // These are the only allowed image types
                        $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
        
                        // if the files exxtensions are valid, upload
                        if(in_array($fileExtension, $allowedExtensions)) {
                            $fileName = Afriadverts::randomStrings(45) . '.' . $file->extension();

                            //Create the directory afterwards
                            if(!is_dir(storage_path('app/banners/' . $path))) {
                                mkdir(storage_path('app/banners/' . $path));
                            }

                            // Get the existing files in the directory
                            $filesInDirectory = explode(",", $advert->ad_images);

                            // Delete the previous files in the directory
                            for($i = 0; $i < (count($filesInDirectory)-1); $i++) {
                                Storage::delete('banners/' . $path . '/' . $filesInDirectory[$i]);
                            }
                            
                            // Store the files
                            $file->storeAs('banners/' . $path, $fileName);
                            $data .= $fileName . ',';
                        }
                    }
                    $advert->ad_images = $data;
                }

        if($advert->save()) {
            return new AdvertResource($advert);
        }
    }


    public function action(Request $request) {
        // Validation
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'advert_id' => 'required|exists:adverts,id',
            'action' => [
                'required',
                Rule::in(['pause', 'resume'])
            ]
        ]);

        if($validator->fails()) {
            return \response()->json([
                $validator->errors()
            ], 403);
        }

        $advert = Advert::findOrFail($request->advert_id);

        if($request->action == "pause") {
            $advert->ad_status = "paused";
            $advert->id = $request->advert_id;
            $advert->user_id = $request->user_id;
        }
        elseif($request->action == "resume") {
            $advert->ad_status = "running";
            $advert->id = $request->advert_id;
            $advert->user_id = $request->user_id;
        }

        if($advert->save()) {
            return new AdvertResource($advert);
        }
    }


    public function deleteAdvert(Request $request) {
        // Validation
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'advert_id' => 'required|exists:adverts,id'
        ]);

        if($validator->fails()) {
            return \response()->json([
                $validator->errors()
            ], 403);
        }

        $advert = Advert::findOrFail($request->advert_id);

        // Get the token of the advert
        $tokenStrings = $advert->advert_token;

        // Get the storage path of the advert
        $path = substr($tokenStrings, 0, 25);

        if($advert->delete()) {
            
            // Delete the directory that contains the advert images
            Storage::deleteDirectory('banners/' . $path);

            return new AdvertResource($advert);
        }
    }
}
