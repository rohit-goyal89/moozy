<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Offer
 * @package App\Models
 * @version February 6, 2022, 5:03 pm UTC
 *
 * @property string $offer
 * @property number $discount
 * @property integer $status
 */
class Offer extends Model
{
    use SoftDeletes;

    public $table = 'offers';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'offer_banner',
        'discount',
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
        'offer_banner' => 'string',
        'discount' => 'decimal:2',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'discount' => 'required',
        'restaurant' => 'required'
    ];

    
    /**
     * The restaurant that belong to the offer.
     */
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurants_offers');
    }

    public function getofferBannerAttribute($value)
    {
        return config('app.url').'/images/'.$value;
    }
}
