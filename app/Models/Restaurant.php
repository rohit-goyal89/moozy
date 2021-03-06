<?php

namespace App\Models;

use Eloquent as Model;
use App\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Restaurant
 * @package App\Models
 * @version February 5, 2022, 11:40 am UTC
 *
 * @property string $name
 * @property string $address
 * @property string $postcode
 * @property string $city
 * @property string $phone
 * @property string $alternate_phone
 * @property string $website
 * @property string $registration_date
 * @property string $gst_number
 * @property string $contact_number
 * @property string $email
 * @property integer $restaurant_type
 * @property string $latitude
 * @property string $longitude
 * @property integer $status
 */
class Restaurant extends Model
{
    use SoftDeletes;

    public $table = 'restaurants';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'name',
        'address',
        'postcode',
        'city',
        'town',
        'phone',
        'alternate_phone',
        'website',
        'registration_date',
        'gst_number',
        'contact_number',
        'owner_name',
        'email',
        'restaurant_type',
        'prepare_time',
        'latitude',
        'longitude',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'address' => 'string',
        'postcode' => 'string',
        'city' => 'string',
        'town' => 'string',
        'phone' => 'string',
        'alternate_phone' => 'string',
        'website' => 'string',
        'registration_date' => 'date',
        'gst_number' => 'string',
        'contact_number' => 'string',
        'email' => 'string',
        'restaurant_type' => 'integer',
        'latitude' => 'string',
        'longitude' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'postcode' => 'required',
        'city' => 'required',
        'town' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'restaurant_type' => 'required',
         'menu' => 'required',   
        'owner_name' => 'required',
        'email' => 'required',
        'manage_restaurant.*.day' => 'required',
        'manage_restaurant.*.open_time' => 'required',
        'manage_restaurant.*.close_time' => 'required',
        'photo' => 'required'
    ];

    public function restaurantDetail() {
        return $this->hasOne(RestaurantDetail::class, 'restaurant_id');
    }

    /**
     * The offer that belong to the restaurant.
     */
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'restaurants_offers');
    }

    /**
     * The user favourite restaurant.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_restaurant');
    }

    /**
     * The restaurant menus.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'restaurant_menu');
    }

    public function ratings()
    {
        return $this->hasMany(RestaurantRating::class, 'restaurant_id');
    }

    public function avgRating()
    {
        return round($this->ratings()->avg("rating"));
    }

     public function manageTime()
    {
        return $this->hasMany(RestaurantManageTime::class, 'restaurant_id');
    }

     /**
     * The user favourite restaurant.
     */
    public function favouriteRestaurants()
    {
        return $this->belongsToMany(User::class, 'user_restaurant');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'restaurant_category');
    }

      public function cart()
    {
        return $this->hasMany(Cart::class, 'restaurant_id');
    }
}
