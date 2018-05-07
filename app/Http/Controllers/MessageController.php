<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\MessageReceived;
use App\Message;
use App\Salesperson;
use App\Branch;
use App\Region;
use App\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\File;
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


    public function store(Request $request)
    {
      $newMessage = new Message;
      $newMessage->user_id_sender = request('idSender');
      $newMessage->message = request('textMessage');
      $newMessage->subject = request('subjectMsg');
      $newMessage->time = new DateTime();
      $newMessage->is_read = 0;
      // return $request -> file('upload') ->store('uploads');
      // $file = $request->file('file')->store('upload');
        // $uploadedFile = $request->file('file');
        // $path = $uploadedFile->storePubliclyAs('upload','public');
        // $file = File::create([
        //   'title' => $request->title ?? $uploadedFile->getClientOriginalName(),'filename'=>$path
        // ]);


      // if(request('file') != null){

          // return $request ->file('file') -> getClientSize();
          // // return  $request -> file('file') -> getClientSize();
          // $filename = $request->file->getClientOriginalName();
          // $filesize = $request->file->getClientSize();
          //
          // $request->file->storeAs('public/upload',$filename);
          // $file = new File;
          // $file->name = $filename;
          // $file->size = $filesize;
          // $file->save();
      // }

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
          return "forbidden";
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
            return "forbidden";
        }




    }


    // public function showRead(){
    //   $id = Auth::id();
    //   $temp=array();
    //   for ($i=0; $i<sizeof(Message::all());$i++) {
    //     array_push($temp,((MessageReceived::select('id_msg')->where('user_id_receiver',$id)->get())[$i]->id_msg));
    //   }
    //
    //
    //   $message = Message::where('id_msg',$msgRcv)->count();
    //
    //   return temp;
    //
    //
    // }

    public function showInbox()
    {



              $id = Auth::id();
              $user = User::find($id);
              $role = $user->is_sp;
              //get sales list as receiver
              $is_salesperson = $user -> Salesperson;
              $is_manager = $user -> Manager;
              $nameSp = array();
              $a=array();



              if ($role == 0)
              {
                $is_bm = Branch::find($id);
                $is_rg = Region:: find($id);

                // branch manager
                if($is_bm !== null){
                //sales person
                $branch_id= $is_bm->level_id;
                $selectedSp = Salesperson::where('branch_level_id',$branch_id)->get();
                $jml = sizeof($selectedSp);

                for($i=0; $i<$jml-1; $i++){
                  $a = Salesperson::select('user_id')->where('branch_level_id',$selectedSp[$i]->branch_level_id)->get();
                }
                foreach($a as $b)
                  array_push($nameSp, $b->user->name);


                }

                // regional manager
                elseif($is_rg !== null){
                //branch manager
                $regional_id = $is_rg->level_id;
                $selectedBranchManager = Branch::where('region_level_id',$regional_id)->get();
                // $jmlSp = sizeof(Salesperson::All());
                $jmlBr = sizeof($selectedBranchManager);

                for($i=0; $i<$jmlBr; $i++){
                  array_push($a, Manager::where('user_id',$selectedBranchManager[$i]->mgr_user_id)->get());

                }
                for($i=0; $i<$jmlBr; $i++){
                  for($j=0; $j<$jmlBr; $j++){

                  array_push($a , Salesperson::where('branch_level_id',$selectedBranchManager[$j]->level_id)->get());
                  }
                }



                foreach($a as $c)
                  foreach($c as $b)
                  array_push($nameSp, $b->user->name);
                }

                //group head
                else{
                  return "gh bro";
                }
              }
              else{
                $branch_id = $is_salesperson[0]->branch_level_id;
                $selectedSp = Salesperson::where('branch_level_id',$branch_id)->get();
                $jml = sizeof($selectedSp);

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

              return view('MessageInbox',compact('messageInbox','id','nameSp'));
          }




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
