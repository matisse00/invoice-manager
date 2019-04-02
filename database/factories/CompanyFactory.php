<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'address' => $faker->streetAddress,
        'nip' => $faker->randomNumber(8),
        'regon' => $faker->randomNumber(8),
        'type' => $faker->word,
        'account_number' => $faker->bankAccountNumber
    ];
});
