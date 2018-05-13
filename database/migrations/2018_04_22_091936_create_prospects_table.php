<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('prospects', function (Blueprint $table) {
          $table->integer('customer_id')->unique()->unsigned();
          $table->longText('notes');
          $table->string('email');
          // $table->integer('address_id')->unsigned();
          $table->integer('customer_type_id')->unsigned();
          $table->integer('prospect_willingness_id')->unsigned();
          $table->integer('cycle'); //buat existing customer, retrieve yang cycle nya > 1
          // tiap kali deal cycle ++ , tiap mau bikin schedule, cycle ngrefer ke sini
          // $table->string('email');

          // $table->foreign('address_id')
          // ->references('id')
          // ->on('addresses')
          // ->onUpdate('restrict')
          // ->onDelete('restrict');

          $table->foreign('prospect_willingness_id')
          ->references('id')
          ->on('prospect_willingnesses')
          ->onUpdate('restrict')
          ->onDelete('restrict');

          $table->foreign('customer_type_id')
          ->references('id')
          ->on('customer_types')
          ->onUpdate('restrict')
          ->onDelete('restrict');

          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospects');
    }
}
