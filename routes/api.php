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
Auth::routes(['verify' => true]);

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('forgot_password', 'UserController@forgot_password');
Route::post('verify', 'UserController@verify');
Route::post('social_login', 'UserController@socialLogin');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('change_password', 'UserController@change_password');
    Route::get('details/{id}', 'UserController@details');
    Route::get('pages', 'PageController@list');
    Route::get('pages/{slug}', 'PageController@detail');
    Route::get('faq', 'FaqController@list');
    Route::get('faq/{id}', 'FaqController@detail');
    Route::get('offer', 'UserController@offers');
    Route::post('update_address', 'UserController@updateAddress');
    Route::post('make_default', 'UserController@makeDefaultAddress');

    Route::get('support', 'UserController@support');
});
