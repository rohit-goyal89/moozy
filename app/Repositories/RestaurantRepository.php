<?php

namespace App\Repositories;

use App\Models\Restaurant;
use App\Repositories\BaseRepository;

/**
 * Class RestaurantRepository
 * @package App\Repositories
 * @version February 5, 2022, 11:40 am UTC
*/

class RestaurantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'postcode',
        'city',
        'phone',
        'alternate_phone',
        'website',
        'registration_date',
        'gst_number',
        'contact_number',
        'email',
        'restaurant_type',
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
        return Restaurant::class;
    }
}
