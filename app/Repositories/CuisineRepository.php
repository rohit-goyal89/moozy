<?php

namespace App\Repositories;

use App\Models\Cuisine;
use App\Repositories\BaseRepository;

/**
 * Class CuisineRepository
 * @package App\Repositories
 * @version February 5, 2022, 10:57 am UTC
*/

class CuisineRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Cuisine::class;
    }
}
