<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\UserAddress;
/**
 * Class Offer
 * @package App\Models
 * @version February 6, 2022, 5:03 pm UTC
 *
 * @property string $offer
 * @property number $discount
 * @property integer $status
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'restaurant_id',
        'address_id',
        'order_amount',
        'discount',
        'tax',
        'delivery_fee',
        'total_amount',
        'order_status',
        'order_notes',
        'delivery_notes',
        'promo_code',
        'discount_video_id'
    ];

    public function menus() {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function userAddress() {
        return $this->belongsTo(UserAddress::class, 'address_id');
    }
    public function restaurant() {
        return $this->belongsTo(UserAddress::class, 'restaurant_id');
    }
    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
     public function orderItemMenus() {
        return $this->hasMany(OrderItemSubmenu::class, 'order_id');
    }
}
