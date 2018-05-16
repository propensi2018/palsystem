<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('statistic_types', function (Blueprint $table) {
          $table->increments('id_types');
          $table->integer('target');
          $table->integer('date');
          $table->integer('id_user_sp')->unsigned()->nullable();
          $table->integer('id_level')->unsigned()->nullable();
          $table->integer('id_product')->unsigned()->nullable();

          $table->foreign('id_user_sp')
          ->references('user_id')
          ->on('salespersons')
          ->onUpdate('cascade')
          ->onDelete('cascade');

          $table->foreign('id_level')
          ->references('id')
          ->on('levels')
          ->onUpdate('restrict')
          ->onDelete('restrict');

          $table->foreign('id_product')
          ->references('id')
          ->on('product_types')
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
        Schema::dropIfExists('statistic_types');
    }
}
