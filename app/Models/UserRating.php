<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Rating
 * @package App\Models
 * @version February 7, 2022, 5:50 pm UTC
 *
 * @property string $title
 * @property string $contact
 * @property integer $is_flag
 */
class UserRating extends Model
{
    use SoftDeletes;

    public $table = 'user_ratings';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'driver_id',
        'rating',
        'review'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'driver_id' => 'integer',
        'rating' => 'integer',
        'review' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    
}
