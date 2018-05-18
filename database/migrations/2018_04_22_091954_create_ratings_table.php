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
            $table->increments('id') ;
            $table->integer('sales_user_id')->unsigned()->nullable();
            $table->string('date');
            $table->integer('product_types_id')->unsigned()->nullable();

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
