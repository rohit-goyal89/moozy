<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
/**
 * Class Rating
 * @package App\Models
 * @version February 7, 2022, 5:50 pm UTC
 *
 * @property string $title
 * @property string $contact
 * @property integer $is_flag
 */
class RestaurantManageTime extends Model
{
    use SoftDeletes;

    public $table = 'restaurant_manage_time';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'restaurant_id',
        'day',
        'open_time',
        'close_time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'restaurant_id' => 'integer',
        'day' => 'integer',
        'open_time' => 'string',
        'close_time' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function restaurants() {
         return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
