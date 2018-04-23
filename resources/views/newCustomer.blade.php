@extends('layouts.master')
 
@section('title', 'Customer')

@section('contents')

  <div data-role="page">

    <div data-role="main" class="ui-content">
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        New Customer
      </button>
     <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <form method="post" action="create/store">  {{ csrf_field() }}
              <div>
                      <div class="modal-header">
          <h4 class="modal-title">Customer Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div><!-- 
                <h3>Customer Information</h3> -->
                <h6>Customer Name:</h6><!-- 
                <label for="username" class="ui-hidden-accessible">Customer Name</label> -->
                <input type="text" name="name" id="name" placeholder="Customer Name">
                <h6>Phone Number:</h6><!-- 
                <label for="phone_number" class="ui-hidden-accessible">Phone Number:</label> -->
                <input type="string" name="telp_no" id="telp_no" placeholder="Phone Number">
                <br>
                <input type="submit" data-inline="true" value="Submit">
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection