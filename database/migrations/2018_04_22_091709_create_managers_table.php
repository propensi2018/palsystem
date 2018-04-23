<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('managers', function (Blueprint $table) {
        $table->integer('user_id')->unsigned()->unique();
        $table->primary('user_id');
        $table->integer('id_mgr');
        $table->boolean('is_gh');

        $table->foreign('user_id')
        ->references('id')
        ->on('users')
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
        Schema::dropIfExists('managers');
    }
}
