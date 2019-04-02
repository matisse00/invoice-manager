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
        factory(App\Company::class, 3)->create();
        factory(App\Invoice::class, 30)->create();
        factory(App\Item::class, 100)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
