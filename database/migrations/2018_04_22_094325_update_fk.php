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

          Schema::table('customers', function($table)
          {
            $table->renameColumn('id_user_sp', 'pic_sp_id');
          });

          Schema::table('customers', function (Blueprint $table) {
            $table->foreign('pic_sp_id')
            ->references('user_id')
            ->on('salespeople')
            ->onUpdate('cascade')
            ->onDelete('cascade');
          });


          Schema::table('addresses', function($table)
          {
              $table->integer('prospect_customer_id')->unsigned()->nullable();

              $table -> foreign('prospect_customer_id')
              ->references('customer_id')
              ->on('prospects')
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
