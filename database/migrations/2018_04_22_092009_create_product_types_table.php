<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('product_types', function (Blueprint $table) {
          $table->increments('id');
          $table->string('desc');
          $table->boolean('is_deleted');
          $table->integer('id_class')->unsigned();

          $table->foreign('id_class')
          ->references('id')
          ->on('product_classes')
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
        Schema::dropIfExists('product_types');
    }
}
