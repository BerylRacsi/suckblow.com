<?php

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

Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/partner', 'Auth\LoginController@showPartnerLoginForm')->name('login.partner');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/partner', 'Auth\RegisterController@showPartnerRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/partner', 'Auth\LoginController@partnerLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/partner', 'Auth\RegisterController@createPartner');

Route::group(['middleware' => ['auth:partner,web']], function () {
	Route::get('/home', 'HomeController@index');
});

/*Admin*/
Route::group(['prefix' => 'admin','middleware' => 'auth:admin'], function () {
	Route::get('/','AdminPanelController@index');

    Route::resource('admin-account','AdminController');
    Route::resource('user-account','UserController');
    Route::resource('partner-account','PartnerController');

    Route::resource('gear','GearController');
    Route::resource('course','CourseController');
});

