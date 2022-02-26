<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 * @version February 26, 2022, 5:43 am UTC
 *
 * @property string $name
 * @property tinyint $is_required
 * @property string $description
 * @property tinyint $status
 */
class Attribute extends Model
{
    use SoftDeletes;

    public $table = 'attributes';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'is_required',
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

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id'); 
    }
}
