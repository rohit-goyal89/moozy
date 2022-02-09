<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version January 16, 2022, 4:34 pm UTC
 *
 */
class RestaurantDetail extends Model
{
    use SoftDeletes;

    public $table = 'restaurant_details';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'restaurant_id', 'shop_licence','gst_pan_number' ,'photo'
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
