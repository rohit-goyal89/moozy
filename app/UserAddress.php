<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 * @version January 16, 2022, 4:34 pm UTC
 *
 */
class UserAddress extends Model
{
    use SoftDeletes;

    public $table = 'user_address';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'address','apt','city','state','postcode','landmark','latitude','longitude','is_default'
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
