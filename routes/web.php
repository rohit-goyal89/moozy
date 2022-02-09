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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify'); // Make sure to keep this as your route name

Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', 'HomeController@index')->middleware('verified');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', 'UserController');
    Route::resource('pages', 'PageController');
    Route::resource('roles','RoleController');
    Route::resource('coupons', 'CouponController');
    Route::resource('categories', 'CategoryController');
    Route::resource('cuisines', 'CuisineController');
    Route::resource('faqs', 'FaqController');
    Route::resource('restaurants', 'RestaurantController');
    Route::resource('offers', 'OfferController');
    Route::resource('supports', 'SupportController');
    Route::resource('menus', 'MenuController');
});