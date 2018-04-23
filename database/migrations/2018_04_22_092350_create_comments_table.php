<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('comments', function (Blueprint $table) {
          $table->increments('id_user_commenter');
          $table->timestamp('time');
          $table->string('message');
          $table->integer('user_id_sender')->unsigned();
          $table->integer('statistic_id')->unsigned();

          $table->foreign('user_id_sender')
          ->references('id')
          ->on('users')
          ->onUpdate('cascade')
          ->onDelete('cascade');
          $table->timestamps();

          $table->foreign('statistic_id')
          ->references('id')
          ->on('statistics')
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
        Schema::dropIfExists('comments');
    }
}
