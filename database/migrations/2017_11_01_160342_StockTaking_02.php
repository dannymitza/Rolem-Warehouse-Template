<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockTaking02 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('stockTaking', function($table){
        $table->string('finishDateTime')->after('dateTime');
        $table->string('requestedBy')->after("dateTime");
        $table->string('plant')->after('requestedBy');
        $table->string('work')->after('plant');
        $table->integer('status')->default(0)->after('work');
      });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('stockTakin', function($table){
        $table->dropColumn('createdBy');
        $table->dropColumn('requestedBy');
        $table->dropColumn('plant');
        $table->dropColumn('work');
        $table->dropColumn('status');
      });
    }
}
