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
class SubMenu extends Model
{
    use SoftDeletes;

    public $table = 'submenus';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'price',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'price' => 'float',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'price' => 'required',
        'prepare_time' => 'required',
    ];
}
