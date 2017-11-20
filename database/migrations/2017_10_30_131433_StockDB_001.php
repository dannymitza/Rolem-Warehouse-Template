<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockDB001 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_stock', function (Blueprint $table) {
            $table->increments('uid')->index();
            $table->string('sap', 11);
            $table->integer('quantity');
            $table->string('rack');
            $table->string('location');
            $table->string('slot');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('warehouse_stock');
    }
}
