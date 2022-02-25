<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notification
 * @package App\Models
 * @version January 22, 2022, 11:38 am UTC
 *
 * @property string $from_date
 * @property string $to_date
 * @property string $coupon_code
 * @property number $discount_type
 * @property number $amount
 * @property number $status
 */
class Notification extends Model
{
    use SoftDeletes;

    public $table = 'notifications';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'role_id',
        'title',
        'description',
        'type',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'type' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    
     public static $rules = [
        'role_id' => 'required',
        'title' => 'required',
        'description' => 'required'
    ];
     

    public static $updaterules = [
        'role_id' => 'required',
        'title' => 'required',
        'description' => 'required'
    ];
    
}
