<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Company::class, 5)->create();
        factory(App\Invoice::class, 100)->create();
        factory(App\Item::class, 500)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
