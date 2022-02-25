<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
/**
 * Class Menu
 * @package App\Models
 * @version February 8, 2022, 6:18 pm UTC
 *
 * @property string $title
 * @property string $description
 * @property integer $status
 */
class Menu extends Model
{
    use SoftDeletes;

    public $table = 'menus';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'restaurant_owner_id',
        'title',
        'price',
        'prepare_time',
        'is_customizable',
        'type',
        'prepare_time',
        'description',
        'image',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'price' => 'float',
        'description' => 'string',
        'prepare_time' => 'integer',
        'is_customizable' => 'integer',
        'type' => 'integer',
        'image' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'price' => 'required',
        'prepare_time' => 'required',
        'is_customizable' => 'required',
    ];

    
    /**
     * The menus that belong to the restaurant.
     */
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_menu');
    }

    /**
     * The restaurant that belong to the offer.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'menu_category');
    }

    public function getImageAttribute($value)
    {
        return config('app.url').'/images/'.$value;
    }

    public function submenus()
    {
        return $this->hasMany(SubMenu::class, 'menu_id');
    }
}
