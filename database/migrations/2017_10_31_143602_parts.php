<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('parts')) {
        Schema::create('parts', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('sap', 11);
            $table->string('client_code', 56);
            $table->string('material');
            $table->string('veneer');
            $table->string('carline');
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
        Schema::drop('parts');
    }
}
