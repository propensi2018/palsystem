<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('appointments', function (Blueprint $table) {
          $table->increments('id');
          $table->boolean('is_a_deal')->nullable();
          $table->integer('id_act_type')->unsigned()->nullable();

          $table->foreign('id_act_type')
          ->references('id')
          ->on('activity_types')
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
        Schema::dropIfExists('appointments');
    }
}
