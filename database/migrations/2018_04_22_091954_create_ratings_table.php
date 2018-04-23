<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ratings', function (Blueprint $table) {
            $table->integer('sales_user_id')->unsigned()->unique();
            $table->primary('sales_user_id');
            $table->date('date');
            $table->integer('score');

            $table->foreign('sales_user_id')
            ->references('user_id')
            ->on('salespersons')
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
        Schema::dropIfExists('ratings');
    }
}
