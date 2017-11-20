<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockDB002 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('warehouse_stock', function($table){
        $table->integer('stockID')->after("slot");
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('warehosue_stock', function($table){
        $table->dropColumn('stockID');
      });
    }
}
