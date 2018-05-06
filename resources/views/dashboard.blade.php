@extends('layouts.master')

@section('title', 'Dashboard')

@section('contents')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>


        <div class="row batas">
          <div class="col-sm-6 col-md-8 col-md-offset-12">
            <div class="container reminder-layout">
              <div class="reminder-form">
                <div class="row reminder-title">
                  <div class="col-sm-6 col-md-12 col-md-offset-12">
                    Statistic
                  </div>
                </div>
                <div class="row reminder-body">
                  <canvas id="myChart" width="400" height="500"></canvas>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(document.getElementById("myChart"), {
  type: 'line',
  data: {
    labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
    datasets: [{
        data: [86,114,106,106,107,111,133,221,783,2478],
        label: "Africa",
        borderColor: "#3e95cd",
        fill: 'origin'
      }, {
        data: [282,350,411,502,635,809,947,1402,3700,5267],
        label: "Asia",
        borderColor: "#8e5ea2",
        fill: 1
      }, {
        data: [168,170,178,190,203,276,408,547,675,734],
        label: "Europe",
        borderColor: "#3cba9f",
        fill: 2,
        Boundary : 'start'
      },
    ]
  },
  options: {
    title: {
      display: true,
      text: 'World population per region (in millions)'
    }
  }
});</script>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-md-offset-12">
            <div class="container reminder-layout">
              <div class="reminder-form">
                <div class="row reminder-title">
                  <div class="col-sm-6 col-md-12 col-md-offset-12">
                    Calendar
                  </div>
                </div>
                <div class="row reminder-body">
                  <div class="col-sm-6 col-md-12 col-md-offset-12">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row batas">
          <div class="col-sm-6 col-md-8 col-md-offset-12">
            <div class="container reminder-layout">
              <div class="reminder-form">
                <div class="row reminder-title">
                  <div class="col-sm-6 col-md-12 col-md-offset-12">
                    Announcement
                  </div>
                </div>
                <div class="row reminder-body">
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-md-offset-12">
            <div class="container reminder-layout">
              <div class="reminder-form">
                <div class="row reminder-title">
                  <div class="col-sm-6 col-md-12 col-md-offset-12">
                    Daily Reminder
                  </div>
                </div>
                <div class="row reminder-body">
                  <div class="col-sm-6 col-md-12 col-md-offset-12">
                    <ul class="demo">
                      @for ($i=0; $i<sizeof($schedules); $i++)
                        @if ($schedules[$i]['telp_flag'] == 0)
                          <a data-toggle="modal" data-target="#myModal{{$schedules[$i]['id_customer']}}">
                            <li>
                              <div class="row">
                                <div class="col-4 col-md-4 col-md-offset-12 reminder-title-sch">
                                  <span class="reminder-title-sch-type-call">CALL</span><br>
                                  <span class="reminder-title-sch-time">{{ $schedules[$i]['time']}}</span>
                                </div>
                                <div class="col-8 col-md-8 col-md-offset-12 reminder-body-customer">
                                  <span class="reminder-body-customer-name">{{ $schedules[$i]['name']}}</span><br>
                                  <span class="reminder-body-customer-telp">{{ $schedules[$i]['telp_no']}}</span>
                                </div>
                              </div>
                              <div href="#" class="note-tooltip" data-toggle="tooltip" data-placement="bottom" title="{{ $schedules[$i]['notes']}}">
                                <hr style="margin: 0px;">
                                <span>Note : {{ $schedules[$i]['notes']}}</span>
                              </div>
                            </li>
                          </a>
                        @elseif ($schedules[$i]['telp_flag'] == 1)
                          <a href="{{ URL::to('../public/appointment/' . $schedules[$i]['id_customer']) }}">
                            <li>
                              <div class="row">
                                <div class="col-4 col-md-4 col-md-offset-12 reminder-title-sch">
                                  <span class="reminder-title-sch-type-appt">APPT</span><br>
                                  <span class="reminder-title-sch-time">{{ $schedules[$i]['time']}}</span>
                                </div>
                                <div class="col-8 col-md-8 col-md-offset-12 reminder-body-customer">
                                  <span class="reminder-body-customer-name">{{ $schedules[$i]['name']}}</span><br>
                                  <span class="reminder-body-customer-telp" class="note-tooltip" data-toggle="tooltip" data-placement="bottom" title="{{ $schedules[$i]['telp_no']}}">{{ $schedules[$i]['street']}}, {{ $schedules[$i]['kelurahan']}}, {{ $schedules[$i]['district']}}</span>
                                </div>
                              </div>
                              <div href="#" class="note-tooltip" data-toggle="tooltip" data-placement="bottom" title="{{ $schedules[$i]['notes']}}">
                                <hr style="margin: 0px;">
                                <span>Note : {{ $schedules[$i]['notes']}}</span>
                              </div>
                            </li>
                          </a>
                        @endif
                        <li>

                          <div class="modal fade" id="myModal{{$schedules[$i]['id_customer']}}">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <form method="post" action="dashboard/scheduleResponse" ng-controller="DateController as dateCtrl">  {{ csrf_field() }}
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
                                    <input type="hidden" name="id" value="{{$schedules[$i]['id']}}">
                                    <input type="hidden" name="id_customer" value="{{$schedules[$i]['id_customer']}}">
                                    <input name="time" id="time" type="datetime-local" min="{{$today}}" class="form-control" >
                                    <h6>Notes:</h6>
                                    <textarea type="text" class="form-control" rows="2" name="notes" id="notes" placeholder="write any response here.."></textarea>
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
                          <hr style="padding: 0px; margin-left: -18px; border-width: 2px; background-color: #D5D5D5;" width="110%">
                      @endfor
                      @if (sizeof($schedules) == 0)
                        <div class="no_act">
                          <span>There are no activities</span>
                        </div>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        </script>
@endsection
