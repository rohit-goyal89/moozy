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
class Cart extends Model
{
    use SoftDeletes;

    public $table = 'cart';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'session_id',
        'restaurant_id',
        'menu_id',
        'instruction',
        'quantity',
        'sub_item'
    ];

    public function menus() {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
