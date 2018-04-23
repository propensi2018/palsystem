@extends('layouts.master')
@section('title','Sent')
@section('contents')
<div class="messages-background">
  <div class="container">
    <div class="messages">
        <div class="messages-title">
          <h2><b>SENT MESSAGES</b></h2>
        </div>


      <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Time</th>
                  </tr>
              </thead>
              <tbody>


              @for($i=sizeof($messageSent)-1; $i>0; $i--)
                <tr class='clickable-row' data-href="{{ URL::to('../public/show/message2/' . $messageSent[$i]['textMessage'][0]->id_msg)}}">
                  <td>{{ $messageSent[$i]['receiverId'][0] ->name}} </td>
                  <td>{{ $messageSent[$i]['textMessage'][0] ->subject}} </td>
                  <td>{{ $messageSent[$i]['textMessage'][0] ->time}} </td>
                </tr>
              </form>
              @endfor
            </tbody>
          </table>
    </div>
  </div>
</div>







            <script>
              jQuery(document).ready(function($) {
              $(".clickable-row").click(function() {
                window.location = $(this).data("href");
              });
              });
            </script>
            <script>
            // $('#example').dataTable( {
            //     "orderFixed": [ 0, 'desc' ]
            //   } );
            // </script>

            <script type="text/javascript" src="tinymce/js/tinymce/jquery.tinymce.min.js"></script>
            <script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
            <script>tinymce.init({ selector: 'textarea' });</script>



@endsection
