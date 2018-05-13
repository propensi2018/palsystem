
@extends('layouts.master')
@section('title','Inbox')
@section('contents')



        <div class="container">
 <!-- CREATE MESSAGE -->
          <div class="messages">
            <div class="messages-title">
              <h2><b>INBOX MESSAGES</b></h2>
            </div>

            <div class="messages-btn-create">
              <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal">Create Message</button>
            </div>

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
                    <form action="messageInbox/store/{{$id}} " method="post" onsubmit="return validate form">  {{ csrf_field() }}
                        <label for="inputReceiver"><b>To:</b><span><font color="red"> *</font></span></label>
                        <select id="receiverUserName" class="form-control" name="receiverUserName" placeholder:"Choose.." required>
                              @foreach ($nameSp as $nameUser)
                                  <option>{{$nameUser}}</option>
                              @endforeach
                        </select>
                        <label for="inputSubject"><b>Subject</b><span><font color="red"> *</font></span></label>
                        <input  class="form-control" placeholder="Enter subject.."id="subjectMsg" name="subjectMsg" required><br>
                       <!-- <textarea class="form-control" id="textMessage" name="textMessage" rows="7" placeholder="Text your message here.."></textarea> -->
                        <textarea class="form-control" id="textMessage" name="textMessage" rows="15" placeholder="Text your message here..."cols="90" ></textarea>
                        <input name="idSender" id="idSender" type="hidden" value="{{$id}}" />
                  <!-- Modal footer -->
                        <div class="modal-footer">
                          <input id="sendButton" type="submit" data-inline="true" value="Send" class="btn btn-primary">
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>



  <!-- TABLE INBOX -->
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Time</th>
                  </tr>
              </thead> 
              <tbody>
                @for($i=sizeof($messageInbox)-1; $i>0; $i--)
                @if($messageInbox[$i]['textMessage'][0]-> is_read == 0)
                  <tr class='clickable-row' style="font-weight: bold;" data-href="{{ URL::to('../public/show/message/' . $messageInbox[$i]['textMessage'][0]->id_msg)}}">

                      <td>
                        {{ $messageInbox[$i]['senderName'][0] -> name}}

                      </td>
                      <td>
                          {{$messageInbox[$i]['textMessage'][0] -> subject}}
                      </td>
                      <td>
                          {{$messageInbox[$i]['textMessage'][0]-> time}}
                      </td>
                  </tr>
                @else
                  <tr class='clickable-row'   data-href="{{ URL::to('../public/show/message/' . $messageInbox[$i]['textMessage'][0]->id_msg)}}">

                      <td>
                        {{ $messageInbox[$i]['senderName'][0] -> name}}

                      </td>
                      <td>
                          {{$messageInbox[$i]['textMessage'][0] -> subject}}
                      </td>
                      <td>
                          {{$messageInbox[$i]['textMessage'][0]-> time}}
                      </td>
                  </tr>
                @endif


                @endfor
              </body>
            </table>
        </div>
    </div>

<!-- ALERT MESSAGE -->

          <!-- The Modal -->
          <div class="modal fade" id="myModalAlert">
          <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content">
             <!-- Modal Header -->
             <div class="modal-header">
               <h4 class="modal-title">Message</h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>

             <!-- Modal body -->
             <div class="modal-body">
               Message successfuly sent!
             </div>

             <!-- Modal footer -->
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
           </div>
          </div>
          </div>


    <script>
      jQuery(document).ready(function($) {
      $(".clickable-row").click(function() {
          window.location = $(this).data("href");
        });
        $("#sendButton").click(function(){
            $("#successSent").show();
        });
      });
    </script>

<!-- ALERT MESSAGE -->
    <script>
            // Get the modal
        var modal = document.getElementById('myModalAlert');

        // Get the button that opens the modal
        var btn = document.getElementById('sendButton');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
          modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
              modal.style.display = "none";
    </script>


    <script type="text/javascript" src="tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector: 'textarea' });</script>

    @endsection
