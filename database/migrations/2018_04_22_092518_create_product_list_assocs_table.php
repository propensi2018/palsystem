<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductListAssocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('product_list_assocs', function (Blueprint $table) {
          $table->increments('assoc_id');
          $table->integer('product_list_id')->unsigned();
          $table->integer('id_ptype')->unsigned();
          $table->integer('amount');
          $table->timestamps();

          $table->foreign('product_list_id')
          ->references('id')
          ->on('product_lists')
          ->onUpdate('cascade')
          ->onDelete('cascade');

          $table->foreign('id_ptype')
          ->references('id')
          ->on('product_types')
          ->onUpdate('cascade')
          ->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_list_assocs');
    }
}
