<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('salespersons', function (Blueprint $table) {
          $table->foreign('branch_level_id')
          ->references('level_id')
          ->on('branches')
          ->onUpdate('cascade')
          ->onDelete('cascade');
        });
          Schema::rename('salespersons', 'salespeople');

          Schema::table('schedules', function (Blueprint $table) {
            $table->foreign('id_user_sp')
            ->references('user_id')
            ->on('salespeople')
            ->onUpdate('cascade')
            ->onDelete('cascade');
          });

          Schema::table('customers', function (Blueprint $table) {
            $table->foreign('id_user_sp')
            ->references('user_id')
            ->on('salespeople')
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
        //
    }
}
