<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);


Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});

// Route::group(['prefix' => 'adv'], function () {
    //     Route::get('/dashboard', 'AdvertiserController@index')->name('advertiser.dashboard');    
    // });
    

//Routes for Dashboards
Route::group(['prefix' => 'dashboard'], function () {
    //For User who has not chosen what to do yet and for switching the different dashboards
    Route::get('/overview', 'HomeController@index')->name('home');

    //Advertiser routes
    Route::get('/advertiser', 'HomeController@advertiser')->name('advertiser.dashboard');
        
    //Publisher routes
    Route::get('/publisher', 'HomeController@publisher')->name('publisher.dashboard');
});


Route::group(['prefix' => 'p'], function () {
    //List all publisher sites
    Route::get('/sites', 'PublisherController@index')->name('publisher.sites');

    //Create new publisher site
    Route::get('/newsite', 'PublisherController@newsite')->name('publisher.newsite');

    //Details for a specific publisher site
    Route::get('/site/{id}', 'PublisherController@site');

});


// //Get all publisher sites
// Route::get('sites', 'SitesController@index');

// //Create new publisher sites
// Route::get('site/new', 'SitesController@new');
