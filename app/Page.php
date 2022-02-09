<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Page
 * @package App\Models
 * @version January 21, 2022, 5:00 am UTC
 *
 * @property string $title
 * @property string $description
 * @property string $meta_tag
 * @property string $meta_key
 * @property string $meta_description
 * @property integer $status
 */
class Page extends Model
{
    use SoftDeletes;

    public $table = 'pages';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'slug',
        'description',
        'meta_tag',
        'meta_key',
        'meta_description',
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
        'meta_tag' => 'string',
        'meta_key' => 'string',
        'meta_description' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'meta_tag' => 'required',
        'meta_key' => 'required'
    ];

    
}
