<?php

namespace App\Repositories;

use App\Models\AttributeValue;
use App\Repositories\BaseRepository;

/**
 * Class AttributeValueRepository
 * @package App\Repositories
 * @version February 26, 2022, 5:45 am UTC
*/

class AttributeValueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
        'quantity',
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
        return AttributeValue::class;
    }
}
