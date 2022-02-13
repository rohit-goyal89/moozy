<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Rule;
use App\Models\Restaurant;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','role_id','mobile_no', 'password', 'status', 'restaurant_name', 'vat_no', 'address','email_verified_at','otp','social_id','social_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255','unique:users'],
        'mobile_no' => ['max:13', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'licence_file' => 'mimes:doc,pdf,docx'

    ];
     

    public static $updaterules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,:id'],
        'mobile_no' => ['max:13', 'unique:users,id,:id'],
        'password' => ['max:8', 'confirmed'],
        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        'licence_file' => 'mimes:doc,pdf,docx|nullable'

    ];
    
    public function userDetail() {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function userAddress() {
        return $this->hasMany(UserAddress::class, 'user_id');
    }

    //  public function getRoleNames()
    // {
    //     return $this->roles->pluck('name');
    // }

    /**
     * The user favourite restaurant.
     */
    public function favouriteRestaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'user_restaurant');
    }

    public function userRestaurantRating() {
        return $this->hasMany(Models\RestaurantRating::class, 'user_id');
    }

    public function userDriverRating() {
        return $this->hasMany(Models\UserRating::class, 'user_id');
    }

}
