<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('schedules', function (Blueprint $table) {
          $table->increments('id');
          $table->boolean('is_done');
          $table->timestamp('time');
          $table->string('response')->nullable();
          $table->string('notes')->nullable();

          $table->integer('schedule_type_id')->unsigned()->nullable();
          $table->integer('id_customer')->unsigned()->nullable();
          $table->integer('id_user_sp')->unsigned()->nullable();
          $table->integer('next_schedule_id')->unsigned()->nullable();

          $table->foreign('schedule_type_id')
          ->references('id')
          ->on('schedule_types')
          ->onUpdate('cascade')
          ->onDelete('cascade');

          $table->foreign('id_customer')
          ->references('id')
          ->on('customers')
          ->onUpdate('cascade')
          ->onDelete('cascade');

          $table->foreign('next_schedule_id')
          ->references('id')
          ->on('schedules')
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
        Schema::dropIfExists('schedules');
    }
}
