<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('statistics', function (Blueprint $table) {
        $table->increments('id');
        $table->longText('data');
        $table->integer('target');
        $table->timestamp('end_date');
        $table->integer('id_types')->unsigned();

        $table->foreign('id_types')
        ->references('id_types')
        ->on('statistic_types')
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
        Schema::dropIfExists('statistics');
    }
}
