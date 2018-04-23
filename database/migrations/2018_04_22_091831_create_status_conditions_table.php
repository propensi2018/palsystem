<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('status_conditions', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('status_id')->unsigned();
        $table->boolean('is_deleted');


        $table->foreign('status_id')
          ->references('id')
          ->on('statuses')
          ->onUpdate('cascade')
          ->onDelete('cascade');

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
        Schema::dropIfExists('status_conditions');
    }
}
