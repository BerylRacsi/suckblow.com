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
    return view('main/welcome');
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

Route::get('/gear','GearController@index');
Route::get('/gear/search','GearController@search');
Route::get('/gear/category/{category}','GearController@selected');
Route::get('/gear/{id}','GearController@show');

Route::get('/course/agency','CourseController@agency');
Route::get('/course/search','CourseController@search');
Route::get('/course/agency/{agency}','CourseController@selected');
Route::get('/course/{id}','CourseController@show');

Route::get('/trip','TripController@index');
Route::get('/trip/search','TripController@search');
Route::get('/usertrip/{id}','UserTripController@show');
Route::get('/partnertrip/{id}','PartnerTripController@show');

/*User & Partner*/
Route::group(['middleware' => ['auth:partner,web']], function () {
	Route::get('/home', 'HomeController@index');
    Route::get('/select','HomeController@select');

    Route::get('dashboard','DashboardController@index');

    Route::get('/post/gear','GearController@create');
    Route::post('/post/gear','GearController@store');

    Route::get('/post/course','CourseController@create');
    Route::post('/post/course','CourseController@store');

});

/*User Exclusive*/
Route::get('/post/usertrip','UserTripController@create')->middleware('auth:web');
Route::post('/post/usertrip','UserTripController@store')->middleware('auth:web');

/*Partner Exclusive*/
Route::get('/post/partnertrip','PartnerTripController@create')->middleware('auth:partner');
Route::post('/post/partnertrip','PartnerTripController@store')->middleware('auth:partner');

/*Admin*/
Route::group(['prefix' => 'admin','middleware' => 'auth:admin'], function () {
	Route::get('/','AdminPanelController@index');

    Route::get('/manage/agency','ManageController@showAgencyList');
    Route::get('/manage/facility','ManageController@showFacilityList');
    Route::post('/manage/agency','ManageController@storeAgency');
    Route::post('/manage/facility','ManageController@storeFacility');
    Route::delete('/manage/agency/{id}','ManageController@deleteAgency');
    Route::delete('/manage/facility/{id}','ManageController@deleteFacility');

    Route::resource('admin-account','AdminController');
    Route::resource('user-account','UserController');
    Route::resource('partner-account','PartnerController');

    Route::resource('gear','GearController');
    Route::resource('course','CourseController');
    Route::resource('usertrip','UserTripController');
    Route::resource('partnertrip','PartnerTripController');
});

