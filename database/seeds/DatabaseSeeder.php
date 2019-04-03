<?php

use App\Company;
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
        if (Company::all()->count() == 0) {
            factory(App\Company::class, 3)->create();
            factory(App\Invoice::class, 30)->create();
            factory(App\Item::class, 100)->create();

            $invoices = App\Invoice::all();

            foreach ($invoices as $invoice) {

                foreach ($invoice->items()->get() as $key => $item) {
                    $item->ordinalnumber = $key + 1;
                    $item->save();
                }
            }
        }

        // $this->call(UsersTableSeeder::class);
    }
}
