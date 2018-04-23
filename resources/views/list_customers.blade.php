<?php
session_start();

?>

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
                        <div class="card-body-title">
                          {{ $allProspectLoop['dataActivityType'][0]->name }}
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
                            
                            @if($allProspectLoop['dataActivityType']!= null)
                              @if($allProspectLoop['dataActivityType'][0]->id>2 )
                                <span class='badge badge-danger'>{{ $allProspectLoop['dataTipeCustomer'][0]-> name }}</span>
                              @else
                                <span class='badge badge-success'>{{ $allProspectLoop['dataTipeCustomer'][0]-> name }}</span>
                              @endif
                            @else
                              <br>
                            @endif
                            @if(sizeof($allProspectLoop['dataTipeWillingness']) !=0 )
                              <span class='badge badge-secondary'>{{ $allProspectLoop['dataTipeWillingness'][0]-> name}}</span>
                            @else
                              <br>
                            @endif
                        </div>
                      </div>
                    </div> 
                    <div class="card-ct-footer">
                        {{$allProspectLoop['dataProspectLengkap']-> notes }}
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

<div class="list-customer">
  <div class="container">

    <h2 style="text-align: center"><b>LIST OF CUSTOMERS</b></h2>

    <div data-role="main" class="ui-content">
      <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#myModal">
        <span> New Customer</span>
      </button>
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
              <h6>Customer Name:</h6>
              <input type="text" class="form-control" name="name" id="name" placeholder="Customer Name" oninvalid="this.setCustomValidity('Please Enter Name')" oninput="setCustomValidity('')" required>
              </input><br>

              <h6>Phone Number:</h6>
                  <input type="tel" class="form-control" name="telp_no" id="telp_no" placeholder="Phone Number" oninvalid="this.setCustomValidity('Please enter valid phone number')" oninput="setCustomValidity('')" minlength="9" maxlength="13" pattern="^[0-9\+\(\)]*$" required>
                    <span class="validity">
                    </span>
                  </input>
            </div>

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
              {{$customerz->telp_no}}
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

                        <h6>Date:</h6>
                        <input type="hidden" name="id_customer" value="{{$customerz -> id}}">
                        <input name="time" id="time" type="datetime-local" min="{{$today}}" class="form-control" ><br>

                        <h6>Notes:</h6>
                        <textarea type="text" class="form-control" rows="2" name="notes" id="notes" placeholder="write any response here.."></textarea><br>

                        <div>
                          <h6>Customer Responses:</h6>
                          <select id="customer_type" class="custom-select col-8 col-sm-9" name="customer_type">
                            <option value="Reject">Reject</option>
                            <option value="Prospect">Prospect</option>
                            <option value="Pending">Pending</option>
                          </select>
                        </div>
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

<script type="text/javascript">
  $("#example").bsFormAlerts({"id": "example"});

  $.fn.bsFormAlerts.defaults = {
  alertid: "bs-form-alert",
  outer_query: "div.control-group",
  css_prefix: "",
  error_css: "error"
  };

  $(document).trigger("set-alert-id-example", {
  "message": "Please enter at least 3 characters",
  "priority": "error"
  });

  $(document).trigger("clear-alert-id.example");

  $(document).trigger("clear-alert-id");
</script>

@endsection
