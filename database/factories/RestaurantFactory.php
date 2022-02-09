<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'address' => $faker->word,
        'postcode' => $faker->word,
        'city' => $faker->word,
        'phone' => $faker->word,
        'alternate_phone' => $faker->word,
        'website' => $faker->word,
        'registration_date' => $faker->word,
        'gst_number' => $faker->word,
        'contact_number' => $faker->word,
        'email' => $faker->word,
        'restaurant_type' => $faker->randomDigitNotNull,
        'status' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
