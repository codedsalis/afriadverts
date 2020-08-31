<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//Site group routes for 'site/{abc}'
Route::group(['prefix' => 'site'], function () {
    //Get site by id
    Route::get('/{id}', 'Api\SitesController@show');
    
    //Get all Ad Units created for a site
    Route::get('/{id}/adunits', 'Api\SitesController@getadunits');


    //Delete a site
    Route::delete('delete/{id}', 'Api\SitesController@destroy');
    
    //Create a new site
    Route::post('/', 'Api\SitesController@store');
    
    //Update a site
    Route::put('/', 'Api\SitesController@store');

    //The '/' route should always be last to avoid introducing bug
});

//Get all sites created by a particular user
Route::get('sites/user/{id}', 'Api\SitesController@usersites');

//Get all sites
Route::get('sites', 'Api\SitesController@index');


// ----------------------------------------------------------------------------------------


//Ad Unit group routes for adunit/{id}
Route::group(['prefix' => 'adunit'], function () {

    //Get a particular ad unit
    Route::get('/', 'Api\AdUnitsController@index');

    //create new ad unit
    Route::post('/', 'Api\AdUnitsController@store');

    //Edit ad unit
    Route::put('/', 'Api\AdUnitsController@store');

    //Delete Ad Unit
    Route::delete('/', 'Api\AdUnitsController@destroy');
});

