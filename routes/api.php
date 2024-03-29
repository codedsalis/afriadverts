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


//Notifications route
Route::group(['prefix' => 'notifications'], function () {
    //Get user notifications
    Route::get('/', 'Api\NotificationsController@index');

    //Mark user notifications read
    Route::post('/', 'Api\NotificationsController@markread');
});

// Route to delete notification
Route::delete('notification/{id}', 'Api\NotificationsController@destroy');


//Settings Routes
Route::group(['prefix' => 'settings'], function () {
    //Account settings
    Route::put('/account', 'Api\SettingsController@account');

    //Password settings
    Route::put('/password', 'Api\SettingsController@password');

    //Payment settings
    Route::put('/payment', 'Api\SettingsController@payment');
});


//Site group routes for 'site/{abc}'
Route::group(['prefix' => 'site'], function () {
    //Get site by id
    Route::get('/{id}', 'Api\SitesController@show');

    //Get all Ad Units created for a site
    Route::get('/{id}/adunits', 'Api\SitesController@getadunits');


    //Delete a site
    Route::delete('/{id}', 'Api\SitesController@destroy');

    //Create a new site
    Route::post('/', 'Api\SitesController@store');

    //Update a site
    Route::put('/', 'Api\SitesController@store');

    //The '/' route should always be last to avoid introducing bug
});

//Get all sites created by a particular user
Route::get('sites/{id}', 'Api\SitesController@usersites');

//Get all sites
Route::get('sites', 'Api\SitesController@index');


// ----------------------------------------------------------------------------------------


// Ad Unit group routes for adunit/{id}
Route::group(['prefix' => 'adunit'], function () {

    // Get all ad units
    Route::get('/', 'Api\AdUnitsController@index');

    // Get a particular ad unit
    Route::get('/{id}', 'Api\AdUnitsController@show');

    // create new ad unit
    Route::post('/', 'Api\AdUnitsController@store');

    // Edit ad unit
    Route::put('/', 'Api\AdUnitsController@store');

    // Delete Ad Unit
    Route::delete('/{id}', 'Api\AdUnitsController@destroy');
});


Route::group(['prefix' => 'adverts'], function () {
    // Advert setup/creation
    Route::post('/adsetup', 'Api\AdvertsController@adsetup');

    // Get advert statistics
    Route::post('/statistics/{id}', 'Api\AdvertsController@adstatistics');

    // Resume and pause advert
    Route::put('/action', 'Api\AdvertsController@action');

    // Update advert setup
    Route::put('/', 'Api\AdvertsController@update');

    // Update advert images
    Route::post('/', 'Api\AdvertsController@updateImages');

    // Delete advert
    Route::delete('/', 'Api\AdvertsController@deleteAdvert');
});

// Save payment records
Route::post('paymentrecords', 'Api\UserController@savePaymentRecords');
