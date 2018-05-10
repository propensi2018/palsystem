<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('customers', function (Blueprint $table) {
          $table->increments('id');
          // $table->string('telp_no');
          $table->string('name');
          $table->integer('id_status_condition')->unsigned()->nullable();
          $table->boolean('is_act');
          $table->integer('pic_sp_id')->unsigned()->nullable();

          $table->foreign('id_status_condition')
          ->references('id')
          ->on('status_conditions')
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
        Schema::dropIfExists('customers');
    }
}
