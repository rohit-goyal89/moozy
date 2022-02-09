<?php

namespace App\Repositories;

use App\Models\Support;
use App\Repositories\BaseRepository;

/**
 * Class SupportRepository
 * @package App\Repositories
 * @version February 7, 2022, 5:50 pm UTC
*/

class SupportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'contact',
        'is_flag'
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
        return Support::class;
    }
}
