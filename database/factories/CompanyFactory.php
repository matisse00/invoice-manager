<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->streetAddress,
        'nip' => $faker->randomDigit,
        'regon' => $faker->randomDigit,
        'type' => $faker->name,
        'account_number' => $faker->bankAccountNumber
    ];
});
