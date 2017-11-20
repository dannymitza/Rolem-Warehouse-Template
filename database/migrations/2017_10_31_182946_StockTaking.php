<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockTaking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('stockTaking')) {
        Schema::create('stockTaking', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->dateTime('dateTime');
        
        }
       );
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
