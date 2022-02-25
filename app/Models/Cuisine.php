<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cuisine
 * @package App\Models
 * @version February 5, 2022, 10:57 am UTC
 *
 * @property string $name
 * @property string $description
 * @property number $status
 */
class Cuisine extends Model
{
    use SoftDeletes;

    public $table = 'cuisines';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'restaurant_owner_id',
        'name',
        'description',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    
}
