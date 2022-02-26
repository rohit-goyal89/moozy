<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AttributeValue
 * @package App\Models
 * @version February 26, 2022, 5:45 am UTC
 *
 * @property string $name
 * @property number $price
 * @property integer $quantity
 * @property integer $status
 */
class AttributeValue extends Model
{
    use SoftDeletes;

    public $table = 'attribute_values';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'attribute_id',
        'name',
        'price',
        'quantity',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'price' => 'double',
        'quantity' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'attribute_id' => 'required',
        'name' => 'required',
        'price' => 'required'
    ];

    
}
