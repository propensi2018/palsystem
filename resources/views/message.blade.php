
@extends('layouts.master')
@section('title','Inbox')
@section('contents')


      <div class="row">
        <div class="col-md-1 col-offset-12"></div>
        <div class="col-md-10 col-offset-12">
          <div class="message-container">
            <div class="container message-tab">
            <div class="row message-content">
              <div class="col-md-2 col-offset-12 message-user">
                <div class="message-user-img">
                  <img  src="{{ url('image/user.svg') }}" alt="icon name">
                </div>
                <span>{{$userSender[0]->name}}</span>
              </div>
              <div class="col-md-10 col-offset-12 message-text">
                <span><b>{{$textMessage[0]->subject}}</b></span>
                <p class="message-time">{{$textMessage[0]->time}}</p>
                {!! $textMessage[0]->message !!}
              </div>
            </div>
            <div class="message-reply">
              <button type="button" class="btn btn-lg btn-message"  data-toggle="modal" data-target="#myModal">Reply</button>
            </div>
          </div>
        </div>
        </div>
      </div>



<!-- REPLY MESSGAE ----------------------------- -->


           <br>



           <!-- The Modal -->
           <div class="modal fade" id="myModal">
             <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">

                 <!-- Modal Header -->
                 <div class="modal-header">
                   <h4 class="modal-title">Modal Heading</h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                 </div>

                 <!-- Modal body -->
                 <div class="modal-body">
                   <form action="messageInbox/store/{{$userSender[0]->id}}" method="post" onsubmit="return validate form">  {{ csrf_field() }}
                       <label for="inputReceiver"><b>To:</b><span><font color="red"> *</font></span></label>
                       <select id="receiverUserName" class="form-control" name="receiverUserName">
                         <option selected>{{$userSender[0]->name}}</option>

                       </select>
                       <br>
                      <label for="inputSubject"><b>Subject</b><span><font color="red"> *</font></span></label>
                      <input  class="form-control" placeholder="Enter subject.."id="subjectMsg" name="subjectMsg" required> <br>
                      <!-- <textarea class="form-control" id="textMessage" name="textMessage" rows="7" placeholder="Text your message here.."></textarea> -->
                      <textarea class="form-control" id="textMessage" name="textMessage" rows="15" placeholder="Text your message here..."cols="90" ></textarea>
                      <input name="idSender" id="idSender" type="hidden" value="{{$userReceiver[0]->id}}" />
                      <input name="idReceiver" id="idReceiver" type="hidden" value="{{$userSender[0]->id}}" />
                 </div>

                 <!-- Modal footer -->
                 <div class="modal-footer">
                    <input type="submit" data-inline="true" value="Reply" class="btn btn-primary">
                 </div>
                   </form>
               </div>
             </div>
           </div>



               <script type="text/javascript" src="tinymce/js/tinymce/jquery.tinymce.min.js"></script>
               <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
               <script>tinymce.init({ selector: 'textarea' });</script>

@endsection
