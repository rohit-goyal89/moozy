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
class Coupon extends Model
{
    use SoftDeletes;

    public $table = 'coupons';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'from_date',
        'to_date',
        'coupon_code',
        'discount_type',
        'amount',
        'min_price',
        'type',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
        'coupon_code' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    
     public static $rules = [
        'from_date' => 'required',
        'to_date' => 'required',
        'coupon_code' => ['required','unique:coupons'],
        'discount_type' => 'required',
        'amount' => 'required',
        'min_price' => 'required',
        'type' => 'required'

    ];
     

    public static $updaterules = [
         'from_date' => 'required',
        'to_date' => 'required',
        'coupon_code' => ['required','unique:coupons,id,:id'],
        'discount_type' => 'required',
         'min_price' => 'required',
        'type' => 'required',
        'amount' => 'required'

    ];
    
}
