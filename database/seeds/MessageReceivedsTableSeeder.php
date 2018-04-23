<?php

use Illuminate\Database\Seeder;
use App\MessageReceived;

class MessageReceivedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      MessageReceived::create( [
      'id_receive_association'=>1,
      'user_id_receiver'=>2,
      'id_msg'=>1,
      'sender_id_receiver'=>1
      ] );


      MessageReceived::create( [
      'id_receive_association'=>2,
      'user_id_receiver'=>4,
      'id_msg'=>2,
      'sender_id_receiver'=>2
      ] );


      MessageReceived::create( [
      'id_receive_association'=>3,
      'user_id_receiver'=>4,
      'id_msg'=>3,
      'sender_id_receiver'=>2
      ] );


      MessageReceived::create( [
      'id_receive_association'=>4,
      'user_id_receiver'=>5,
      'id_msg'=>4,
      'sender_id_receiver'=>3
      ] );


      MessageReceived::create( [
      'id_receive_association'=>5,
      'user_id_receiver'=>5,
      'id_msg'=>5,
      'sender_id_receiver'=>3
      ] );


      MessageReceived::create( [
      'id_receive_association'=>6,
      'user_id_receiver'=>6,
      'id_msg'=>6,
      'sender_id_receiver'=>4
      ] );


      MessageReceived::create( [
      'id_receive_association'=>7,
      'user_id_receiver'=>7,
      'id_msg'=>7,
      'sender_id_receiver'=>4
      ] );


      MessageReceived::create( [
      'id_receive_association'=>8,
      'user_id_receiver'=>13,
      'id_msg'=>8,
      'sender_id_receiver'=>5
      ] );


      MessageReceived::create( [
      'id_receive_association'=>9,
      'user_id_receiver'=>14,
      'id_msg'=>9,
      'sender_id_receiver'=>5
      ] );


      MessageReceived::create( [
      'id_receive_association'=>10,
      'user_id_receiver'=>7,
      'id_msg'=>10,
      'sender_id_receiver'=>6
      ] );


      MessageReceived::create( [
      'id_receive_association'=>11,
      'user_id_receiver'=>7,
      'id_msg'=>11,
      'sender_id_receiver'=>6
      ] );


      MessageReceived::create( [
      'id_receive_association'=>12,
      'user_id_receiver'=>6,
      'id_msg'=>12,
      'sender_id_receiver'=>7
      ] );


      MessageReceived::create( [
      'id_receive_association'=>13,
      'user_id_receiver'=>6,
      'id_msg'=>13,
      'sender_id_receiver'=>7
      ] );


      MessageReceived::create( [
      'id_receive_association'=>14,
      'user_id_receiver'=>10,
      'id_msg'=>14,
      'sender_id_receiver'=>8
      ] );


      MessageReceived::create( [
      'id_receive_association'=>15,
      'user_id_receiver'=>9,
      'id_msg'=>15,
      'sender_id_receiver'=>8
      ] );


      MessageReceived::create( [
      'id_receive_association'=>16,
      'user_id_receiver'=>10,
      'id_msg'=>16,
      'sender_id_receiver'=>9
      ] );


      MessageReceived::create( [
      'id_receive_association'=>17,
      'user_id_receiver'=>8,
      'id_msg'=>17,
      'sender_id_receiver'=>9
      ] );


      MessageReceived::create( [
      'id_receive_association'=>18,
      'user_id_receiver'=>8,
      'id_msg'=>18,
      'sender_id_receiver'=>10
      ] );


      MessageReceived::create( [
      'id_receive_association'=>19,
      'user_id_receiver'=>9,
      'id_msg'=>19,
      'sender_id_receiver'=>10
      ] );        //
    }
}
