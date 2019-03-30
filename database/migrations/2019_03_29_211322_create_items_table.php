<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('invoice_id')->unsigned()->index();
            $table->integer('ordinalnumber');
            $table->char('name');
            $table->char('unit', 10);
            $table->decimal('amount', 10, 2);
            $table->tinyInteger('quantity');
            $table->float('vat', 3, 2);
            $table->decimal('netsum', 10, 2);
            $table->decimal('grosssum', 10, 2);
            $table->timestamps();
        });

        Schema::table('items', function(Blueprint $table) {
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
