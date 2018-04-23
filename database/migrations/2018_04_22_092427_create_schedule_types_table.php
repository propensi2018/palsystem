<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('schedule_types', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('appointment_id')->unsigned()->nullable();
          $table->boolean('telp_flag');

          $table->foreign('appointment_id')
          ->references('id')
          ->on('appointments')
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
        Schema::dropIfExists('schedule_types');
    }
}
