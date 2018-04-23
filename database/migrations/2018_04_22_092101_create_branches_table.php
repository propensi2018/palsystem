<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('branches', function (Blueprint $table) {
          $table->integer('level_id')->unsigned()->unique();
          $table->primary('level_id');
          $table->integer('branch_id')->unsigned();
          $table->integer('mgr_user_id')->unsigned();
          $table->integer('region_level_id')->unsigned();
          $table->integer('address_id')->unsigned();
          $table->timestamps();

          $table->foreign('mgr_user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

          $table->foreign('region_level_id')
            ->references('level_id')
            ->on('regions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

          $table->foreign('address_id')
            ->references('id')
            ->on('addresses')
            ->onUpdate('restrict')
            ->onDelete('restrict');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
