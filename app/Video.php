<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Coupon
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
class Video extends Model
{
    use SoftDeletes;

    public $table = 'video_discount';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'url',
        'file',
        'discount_type',
        'amount',
        'min_price',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'url' => 'string',
        'file' => 'string',
        'discount_type' => 'integer',
        'amount' => 'integer',
        'min_price' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    
     public static $rules = [
        'url' => 'required_without:file',
        'file' => 'required_without:url',
        'discount_type' => 'required',
        'amount' => 'required',
        'min_price' => 'required',
        'type' => 'required'

    ];
     

    public static $updaterules = [
        'url' => 'required_without:file',
        'file' => 'required_without:url',
        'discount_type' => 'required',
        'min_price' => 'required',
        'type' => 'required',
        'amount' => 'required'

    ];
    
}
