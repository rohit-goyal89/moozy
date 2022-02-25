<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Support
 * @package App\Models
 * @version February 7, 2022, 5:50 pm UTC
 *
 * @property string $title
 * @property string $contact
 * @property integer $is_flag
 */
class Support extends Model
{
    use SoftDeletes;

    public $table = 'supports';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'role_id',
        'title',
        'contact',
        'is_flag'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'contact' => 'string',
        'is_flag' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'role_id' => 'required',
        'title' => 'required',
        'contact' => 'required',
        'is_flag' => 'required'
    ];

    
}
