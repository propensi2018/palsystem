<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageReceivedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('message_receiveds', function (Blueprint $table) {
          $table->increments('id_receive_association');
          $table->integer('user_id_receiver')->unsigned();
          $table->integer('id_msg')->unsigned();
          $table->integer('sender_id_receiver')->unsigned();

          $table->foreign('user_id_receiver')
          ->references('id')
          ->on('users')
          ->onUpdate('cascade')
          ->onDelete('cascade');

          $table->foreign('id_msg')
          ->references('id_msg')
          ->on('messages')
          ->onUpdate('restrict')
          ->onDelete('restrict');

          $table->foreign('sender_id_receiver')
          ->references('id')
          ->on('users')
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
        Schema::dropIfExists('message_receiveds');
    }
}
