<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockTakingResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('stockTakingResults')) {
        Schema::create('stockTakingResults', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('sap', 11);
            $table->string('quantity');
            $table->string('locations');
            $table->text('stockID');
        });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stockTakingResults');
    }
}
