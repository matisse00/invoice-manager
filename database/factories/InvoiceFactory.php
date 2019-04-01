<?php

use App\Company;
use Faker\Generator as Faker;

$factory->define(App\Invoice::class, function (Faker $faker) {
    return [
        'company_id' => function () {
            return Company::all()->random();
        },
        'invoice_number' => $faker->randomNumber(),
        'invoice_date' => $faker->date(),
        'sell_date' => $faker->date(),
        'payment_date' => $faker->date(),
        'payer_name' => $faker->name,
        'payer_address' => $faker->address,
        'payer_nip' => $faker->randomNumber(),
    ];
});
