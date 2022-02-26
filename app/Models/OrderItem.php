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
class OrderItem extends Model
{
    use SoftDeletes;

    public $table = 'order_items';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_id',
        'menu_id',
        'amount',
        'qty',
        'instuction'
    ];

    public function menus() {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
