<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('regions', function (Blueprint $table) {
          $table->integer('level_id')->unsigned()->unique();
          $table->primary('level_id');
          $table->integer('region_id')->unsigned();
          $table->integer('mgr_user_id')->unsigned();
          #$table->integer('region_level_id')->unsigned()->unique();
          $table->integer('address_id')->unsigned();

          $table->foreign('mgr_user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

          $table->foreign('address_id')
            ->references('id')
            ->on('addresses')
            ->onUpdate('restrict')
            ->onDelete('restrict');

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
        Schema::dropIfExists('regions');
    }
}
