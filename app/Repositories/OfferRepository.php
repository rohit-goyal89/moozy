<?php

namespace App\Repositories;

use App\Models\Offer;
use App\Repositories\BaseRepository;

/**
 * Class OfferRepository
 * @package App\Repositories
 * @version February 6, 2022, 5:03 pm UTC
*/

class OfferRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'offer',
        'discount',
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
        return Offer::class;
    }
}
