<?php
session_start();

?>
@if (session('alertFailed'))
    <div class="alert alert-success">
        {{ session('alertFailed') }}
    </div>
@endif

@extends('layouts.master')
@section('title', 'Customer')
@section('contents')
  <style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    .slider {
        width: 90%;
        margin: 100px auto;
    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: 1;
    }

    .slick-active {
      opacity: .5;
    }

    .slick-current {
      opacity: 1;
    }
  </style>

    <div id="div-judul">

        <h2 style="text-align: center"><b>PROSPECT LIST</b></h2>

    </div>
      <div class="">
        <div class="list-card">
              @if(sizeof($temp)==null)
                <div id="inner-no">
                  <h6>No prospect</h6>
              @else
                <div id="inner">
              @endif
              <section class="regular slider">
      		    @foreach ($temp as $keys => $allProspectLoop)
                <div class="card-slider">
                <div class="card-ct">
                  <a id="card-klik" href="{{ URL::to('../public/customer/' . $allProspectLoop['dataCustomer'][0]->id)}}">
                    <div class="card-ct-body">
                      @if($allProspectLoop['dataActivityType']!= null)
                        <div style="color: green" class="card-body-title">
                          {{ $allProspectLoop['dataActivityType'][0]->name}}
                        </div>
                      @else
                        <br>
                      @endif
                      <div>

                        <span class="card-body-title-name">{{$allProspectLoop['dataCustomer'][0]-> name}}</span><br>
                        <span class="card-body-title-telp">{{$allProspectLoop['dataCustomer'][0]-> telp_no}}</span>

                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-md-12 col-md-offset-12 card-body-status">

                            @if($allProspectLoop['dataTipeCustomer']!= null && $allProspectLoop['dataTipeWillingness']!=null)
                            @if($allProspectLoop['dataTipeCustomer'][0]-> name == 'Hot')
                            <span class='badge badge-danger'>{{ $allProspectLoop['dataTipeCustomer'][0]-> name }}</span>
                            @else
                            <span class='badge badge-success'>{{ $allProspectLoop['dataTipeCustomer'][0]-> name }}</span>
                            @endif
                             <span class='badge badge-secondary'>{{ $allProspectLoop['dataTipeWillingness'][0]-> name}}</span>

                            @else
                              <span class='badge badge-success'>Warm</span>
                               <span class='badge badge-secondary'>Conservative</span>

                            @endif

                        </div>
                      </div>
                    </div>
                    <div class="card-ct-footer">

                          {{$allProspectLoop['dataProspectLengkap']['notes'] }}

                    </div>
                  </a>
                </div>
              </div>
              @endforeach
              </section>
            </div>
        </div>
      </div>

<style type="text/css">

.form-control[type="number"] {
  width: 100px;
}

.form-control + span {
  padding-right: 30px;
}

.form-control:invalid+span:after {
  position: absolute; content: ' ';
  padding-left: 5px;
  color: #8b0000;
}

.form-control:valid+span:after {
  position: absolute;
  content: '✓';
  padding-left: 5px;
  color: #009000;
}

select {
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;       /* remove default arrow */
   background-image: url(...);   /* add custom arrow */
}
</style>


<!-- Maktal Punya -->
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.0-beta.5/angular.min.js"></script>

<script>
    var total_number = 0;
</script>

@if (session('alertCSV')) 
  <div class="alert alert-success">
    {{session('alertCSV')}}
  </div>
@endif

@if ($errors->any())
  @if($errors ->has('file_csv'))
  <div class="alert alert-danger">
    Your action has not been successful. Please check your input again. (CSV ERROR)
  </div>
  
  @else
  <div class="alert alert-danger">
    Your action has not been successful. Please check your input again. (PHONE NUMBER ERROR)
  </div>
  @endif
@endif
<div class="list-customer">
  <div class="container">

    <h2 style="text-align: center"><b>LIST OF CUSTOMERS</b></h2>

    <br>
    <div class="row">
      <div class="col-sm-4 col-md-4 col-md-offset-12">
        <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#myModal">
          <span> New Customer</span>
        </button>
      </div>
      <div class="col-sm-4 col-md-3 col-md-offset-12" style="text-align: right; padding-right: 0px;">
        <p>Upload Customer's List (.csv) : </p>
      </div>
      <div class="col-sm-4 col-md-5 col-md-offset-12">
        <form method="POST" action="customer/storeCsv" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="file" name="file_csv"></input>
          
        <input type="submit" name="submit" class="btn btn-primary float-right" value="Upload"></input>
        </form>
      </div>
    </div>

    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="newCust" method="post" onsubmit="return validateForm()" action="customer/store">  {{ csrf_field() }}

            <div class="modal-header">
              <h4 class="modal-title">Customer Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
            </div>

            <div class="modal-body">
              <h6>Customer Name<span><font color="red">* </font></span>:</h6>
              <input type="text" class="form-control" name="name" id="name" placeholder="Customer Name" oninvalid="this.setCustomValidity('Please Enter Name')" oninput="setCustomValidity('')" required>
              </input><br>

              <div class="form-group row">
                <div class="col-md-4 col-md-offset-12">
                </div>
                <div class="col-sm-6 col-md-6 col-md-offset-12">
                  <button id ='adders' type='button' class="btn btn-secondary">Add More Phone Number</button>
                  <button id ='deleters' type='button' style = 'display: none' class="btn btn-danger">Delete More Product</button>
                </div>
              </div>

              <div id="number_container">
                <div id="number0">
                  <h6>Phone Number<span><font color="red">* </font></span>:</h6>
                    <input type="tel" class="form-control" name="telp_no_0" id="telp_no_0" placeholder="Phone Number" oninvalid="this.setCustomValidity('Please enter valid phone number')" oninput="setCustomValidity('')" minlength="9" maxlength="13" pattern="^[0-9\+\(\)]*$" required>
                      <span class="validity">
                      </span>
                    </input>
                </div>
              </div>
            </div>

            <input id="total_number" name="total_number" type="hidden" val="1">

            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" data-inline="true" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>

  <!-- Modal Fill Response -->
    <div data-role="page" ng-app="dateInputExample" class="data-table">
      <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>
          <tr>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Response</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($customery as $customerz)
          <tr>
            <td>
              {{$customerz->name}}
            </td>
            <td>
              @foreach($customerz ->telephones as $telephone)
              <p><!-- {{$loop->iteration}} : --> {{$telephone->telp_no}}</p>
              @endforeach
              <!-- {{$customerz->telp_no}} -->
            </td>
            <td>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$customerz->id}}">Fill Response</button>

              <div class="modal fade" id="myModal{{$customerz->id}}">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">

                    <form method="post" action="customer/storeResponse" ng-controller="DateController as dateCtrl">  {{ csrf_field() }}

                      <div class="modal-header">
                        <h4 class="modal-title">Customer Response:</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;
                        </button>
                      </div>

                      <div class="modal-body" ng-app="dateInputExample">
                        <script>
                          angular.module('dateInputExample', []) .controller('DateController', ['$scope', function($scope) {
                            $scope.example = {
                            value: new Date(2015, 3, 22), currentDate: new Date()
                            };
                          }]);
                        </script>

                        <div class="row">
                          <div class="col-sm-6 col-md-6 col-md-offset-12">
                            <h6>Customer Responses<span><font color="red">* </font></span>:</h6>
                            <select id="customer_type" class="custom-select" name="customer_type">
                              <option value="Prospect">Prospect</option>
                              <option value="Pending">Pending</option>
                              <option value="Reject">Reject</option>
                            </select>
                          </div>

                          <div class="col-sm-6 col-md-6 col-md-offset-12">
                            <h6>Date<span><font color="red">* </font></span>:</h6>
                            <input type="hidden" name="id_customer" value="{{$customerz -> id}}">
                            <input name="time" id="time" type="datetime-local" min="{{$today}}" class="form-control" >
                          </div>
                        </div>
                        <br>
                        <h6>Notes:</h6>
                        <textarea type="text" class="form-control" rows="2" name="notes" id="notes" placeholder="write any response here.."></textarea><br>
                      </div>

                      <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" data-inline="true" value="Submit">
                      </div>

                    </form>
                  </div>
                </div>
              </div>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="list-customer">
  <div class="container">
     <!-- Existing Customer Table -->
      <h2 style="text-align: center"><b>EXISTING CUSTOMERS</b></h2>
      <div data-role="page" ng-app="dateInputExample" class="data-table">
        <table id="example" class="table table-striped table-bordered" style="width:100%">

          <thead>
            <tr>
              <th>Name</th>
              <th>Last Deal</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($exCust as $exCustView)
            <tr class='clickable-row' data-href="{{ URL::to('../../palsystem/public/customer/' . $exCustView->customer_id)}}">
              <td>
                  {{$exCustView->name}}
              </td>
              <td>
                {{$exCustView->updated_at}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
</div>

<script type="text/javascript">
   $('#adders').click(function(){
    total_number += 1;
    $('#total_number').val(total_number + 1);
    if (total_number == 1) {
      $('#deleters').show();
    }

    var added = $("#number0").clone();
    var addid = 'number' + total_number;
    added.attr('id', addid);
    added.find('input').val("");
    added.appendTo("#number_container");
    $('#' + addid).find('input')
      .attr('name','telp_no_' + total_number)
      .attr('id','telp_no_' + total_number);
  });
  $('#deleters').click(function(){
    //alert(total_product);
    $('#number' + total_number).remove();
    total_number -= 1;
    $('#total_number').val(total_number + 1);
    // refresh();
    if (total_number <= 0) {
      $('#deleters').hide();
    }
  });

  // $("#example").bsFormAlerts({"id": "example"});

  // $.fn.bsFormAlerts.defaults = {
  // alertid: "bs-form-alert",
  // outer_query: "div.control-group",
  // css_prefix: "",
  // error_css: "error"
  // };

  // $(document).trigger("set-alert-id-example", {
  // "message": "Please enter at least 3 characters",
  // "priority": "error"
  // });

  // $(document).trigger("clear-alert-id.example");

  // $(document).trigger("clear-alert-id");

  // Adding more phone number


</script>
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

@endsection
