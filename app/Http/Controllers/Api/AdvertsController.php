<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\AdvertResource;
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
                $data = array();
                
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
                        $data[] = $fileName;
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
                $advert->daily_budget = (integer)$request->input('daily_budget');
                $advert->ad_budget = (integer)$request->input('total_budget');
                $advert->ad_cpc = (integer)$request->input('cpc');
                $advert->duration = strtotime($request->input('duration'));
                $advert->ad_images = \json_encode($data);
    
    
                if($advert->save()) {
                    return new AdvertResource($advert);
                }
            }
            
        }

    }
}
