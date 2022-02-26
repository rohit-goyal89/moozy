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
class OrderItemSubmenu extends Model
{
    use SoftDeletes;

    public $table = 'order_items_submenu';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_id',
        'menu_id',
        'submenu_id',
    ];

    public function menus() {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function attributes() {
        return $this->belongsTo(Attribute::class, 'submenu_id');
    }
}
