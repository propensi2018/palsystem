<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MessageReceived;
use App\Message;
use App\Salesperson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DateTime;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('messageForm');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store()
    {
      $newMessage = new Message;
      $newMessage->user_id_sender = request('idSender');
      $newMessage->message = request('textMessage');
      $newMessage->subject = request('subjectMsg');
      $newMessage->time = new DateTime();
      $newMessage->is_read = 0;
      $newMessage->save();
      // $newMessage->id_msg = request('idMsg'); Auto increment?


      $newMessageReceived = new MessageReceived;
      $newMessageReceived->user_id_receiver = (User::select('id')->where('name',request('receiverUserName'))->get())[0]->id;
      $newMessageReceived->sender_id_receiver = request('idSender');
      $newMessageReceived->id_msg = sizeof(Message::select('id_msg')->get());

      $newMessageReceived->save();

    //  return redirect()->route('show/messageInbox/'. request('idSender'));

      return redirect()->route('show-inbox');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_all()
    {

    }

    public function showMessage($id)
    {

      $textMessage = Message::select('message','time','subject')->where('id_msg',$id)->get();
      $userIdSender = MessageReceived::select('sender_id_receiver','user_id_receiver')->where('id_msg',$id)->get();
      $userSenderId = $userIdSender[0] ->sender_id_receiver;
      $userReceiverId = $userIdSender[0] ->user_id_receiver;
      $userSender = User::select('name','id')->where('id',$userSenderId)->get();
      $userReceiver = User::select('name','id')->where('id',$userReceiverId)->get();
      Message::where('id_msg', $id)->update(['is_read' => 1]);

      if(Auth::id() == $userIdSender[0]->user_id_receiver){
            return view('message',compact('textMessage','userSender','userReceiver'));
      }
        else {
          return "gabisa lho";
        }





           // return  compact('textMessage','userSender');
    }


     public function showMessage2($id)
    {


        $textMessage = Message::select('message','time','subject')->where('id_msg',$id)->get();
        $userIdReceiver = MessageReceived::select('user_id_receiver','sender_id_receiver')->where('id_msg',$id)->get();
        $userReceiverId = $userIdReceiver[0]->user_id_receiver;
        $userReceiver = User::select('name')->where('id',$userReceiverId)->get();
        if (Auth::id() ==  $userIdReceiver[0]->sender_id_receiver) {
            return view('message2',compact('textMessage','userReceiver'));
        } else {
            return "gabisa lho";
        }




    }




    public function showInbox()
    {



              $id = Auth::id();
              $user = User::find($id);
              $is_salesperson = $user -> Salesperson;
              $branch = $is_salesperson[0]->branch_level_id;
              $selectedSp = Salesperson::where('branch_level_id',$branch)->get();
              $jml = sizeof($selectedSp);
              $tempSp = array();
              $nameSp = array();
              $a=array();

              $is_manager = $user -> Manager;
              if ($is_salesperson == null)
              {
                  return 'dia adalah manager';
                  // $userReceiverList = Manager::select('name');
              }
              else
              {

                for($i=0; $i<$jml-1; $i++){

                  $a = Salesperson::select('user_id')->where('branch_level_id',$selectedSp[$i]->branch_level_id)->get();

                }
                foreach($a as $b)
                  array_push($nameSp, $b->user->name);
              }

              $userReceiver = MessageReceived::where('user_id_receiver',$id)->get();
              $jumlah = sizeof($userReceiver);
              $tempMsg = array();
              $tempSndrId = array();
              $messageInbox = array();
              for ($i=0; $i<=$jumlah-1 ;$i++){
                  array_push($tempMsg, Message::select('message','id_msg','time','subject','is_read')->where('id_msg',$userReceiver[$i]->id_msg)->get());
                  array_push($tempSndrId, User::select('name')->where('id',$userReceiver[$i]->sender_id_receiver)->get());
                  $messageInbox[] =  array('senderName' => $tempSndrId[$i],'textMessage'=> $tempMsg[$i] );
              }

              return view('MessageInbox',compact('messageInbox','id','tempSp','nameSp'));
          }






        // return compact('messageInbox','id','tempSp','nameSp');





    public function showSent()
    {
        $id = Auth::id();
        $userSender = MessageReceived::where('sender_id_receiver',$id)->get();
        $jumlah = sizeof($userSender);
        $tempMsg = array();
        $tempReceiverId = array();
        $time = array();
        $messageSent = array();

        for ($i=0; $i<=$jumlah-1 ;$i++){
            array_push($tempMsg, Message::select('message','id_msg','time','subject')->where('id_msg',$userSender[$i]->id_msg)->get());
            // array_push($time, Message::select('time')->where('id_msg',$userSender[$i]->id_msg)->get());
            array_push($tempReceiverId, User::select('name')->where('id',$userSender[$i]->user_id_receiver)->get());
            $messageSent[] = array('receiverId' => $tempReceiverId[$i],'textMessage'=>$tempMsg[$i]);
        }

        //return compact('messageSent');
         return view('MessageSent',compact('messageSent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
