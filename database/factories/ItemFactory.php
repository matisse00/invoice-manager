<?php

use App\Invoice;
use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    return [
        'invoice_id' => function () {
            return Invoice::all()->random();
        },
        'ordinalnumber' => $faker->numberBetween(1, 20),
        'name' => $faker->name,
        'unit' => $faker->text(10),
        'amount' => $faker->randomFloat(2, 1, 300),
        'quantity' => $faker->numberBetween(1, 20),
        'vat' => $faker->randomFloat(2, 0, 1),
        'netsum' => $faker->randomFloat(2, 1, 1000),
        'grosssum' => $faker->randomfloat(2, 1, 1000),
    ];
});
