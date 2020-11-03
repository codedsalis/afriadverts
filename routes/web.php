<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

    //Advertiser dashboard
    Route::get('/advertiser', 'HomeController@advertiser')->name('advertiser.dashboard');

    //Publisher dashboard
    Route::get('/publisher', 'HomeController@publisher')->name('publisher.dashboard');
});


//Route for settings
Route::get('settings', 'HomeController@settings');

//Route for notifications
Route::get('notifications', 'HomeController@notifications');



// Routes for publishers
Route::group(['prefix' => 'p'], function () {
    //List all publisher sites
    Route::get('/sites', 'PublisherController@index')->name('publisher.sites');

    //Create new publisher site
    Route::get('/newsite', 'PublisherController@newsite')->name('publisher.newsite');

    //Details for a specific publisher site
    Route::get('/site/{id}', 'PublisherController@site');

    //create a new ad unit
    Route::get('/newadunit/{id}', 'PublisherController@newadunit');

    //Get a particular ad unit
    Route::get('/adunit/{id}', 'PublisherController@adunit');
});

// Routes for advertisers
Route::group(['prefix' => 'a'], function () {
    
    // New advert
    Route::get('/newadvert', 'AdvertiserController@newadvert');

    // Advert setup
    Route::get('/adsetup', 'AdvertiserController@adsetup');
});


// //Get all publisher sites
// Route::get('sites', 'SitesController@index');

// //Create new publisher sites
// Route::get('site/new', 'SitesController@new');
