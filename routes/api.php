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
Route::post('resend_otp', 'UserController@resend_otp');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('change_password', 'UserController@change_password');
    Route::get('details/{id}', 'UserController@details');
    Route::get('pages', 'PageController@list');
    Route::post('pages', 'PageController@detail');
    Route::get('faq', 'FaqController@list');
    Route::get('faq/{id}', 'FaqController@detail');
    Route::post('offer', 'UserController@offers');
    Route::post('update_address', 'UserController@updateAddress');
    Route::post('make_default', 'UserController@makeDefaultAddress');
    Route::post('get_address', 'UserController@getAddress');
    Route::post('logout', 'UserController@logout');

    Route::get('support', 'UserController@support');
    Route::get('sort_type', 'RestaurantController@sortType');
    Route::post('notifications', 'UserController@notifications');
    Route::post('delete_address', 'UserController@deleteAddress');
    Route::post('set_notification', 'UserController@setNotification');
    Route::post('get_notification', 'UserController@getNotification');
    Route::post('cuisine', 'RestaurantController@cuisine');
    Route::post('nearest_restaurant', 'RestaurantController@nearestRestaurant');
    Route::post('popular_restaurant', 'RestaurantController@popularRestaurant');
    Route::post('frequently_restaurant', 'RestaurantController@frequentlyOrderRestaurant');
    Route::post('restaurant_list', 'RestaurantController@restaurantList');
    Route::post('menus', 'RestaurantController@topMenu');
    Route::post('add_to_favourite', 'RestaurantController@addToFavourite');
    Route::post('remove_favourite', 'RestaurantController@removeFavourite');
    Route::post('create_review_rating', 'RestaurantController@createReviewRating');
    Route::post('update_profile', 'UserController@updateProfile');
    Route::post('my_favourite_restaurant', 'RestaurantController@myFavouriteRestaurant');
    Route::post('restaurant', 'RestaurantController@view');
    Route::post('add_driver_review_rating', 'UserController@addDriverReviewRating');
});
