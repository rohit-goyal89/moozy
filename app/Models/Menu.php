<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'title',
        'description',
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
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

    
    /**
     * The menus that belong to the restaurant.
     */
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_menu');
    }

}
