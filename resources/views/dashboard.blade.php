@extends('layouts.master')

@section('title', 'Dashboard')

@section('contents')

<?php
// Set your timezone!!
date_default_timezone_set('Asia/Jakarta');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $timestamp = time();
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$bulan = substr($ym, 5, 2);
$tahun = substr($ym, 0, 4);
$html_title = $bulan. '-' .date('j', time()) .'-'. $tahun;

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

// Number of days in the month
$day_count = date('t', $timestamp);

// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {

    $date = $ym.'-'.$day;

    if ($today == $date) {
        $week .= '<td class="today">'.$day;
    } elseif (sizeof($sched_cal) > 0 && $role == 'salesperson') {
        if ($day <= 9) {
          $date = $ym.'-0'.$day;
        }
        for ($i=0; $i<sizeof($sched_cal); $i++) {
          $act = $sched_cal[$i]['act'];
          if ($act == $date) {
            $week .= '<td class="activity_cal" data-toggle="modal" data-target="#myModal'.$act.'">'.$day;
            break;
          } else if ($i+1 == sizeof($sched_cal)) {
            $week .= '<td>'.$day;
          }
        }
    } else {
        $week .= '<td>'.$day;
    }
    $week .= '</td>';

    if ($role == 'salesperson') {
    $date_d = substr($act, 8);
    $date_click = date('M Y', time());
    $week .= '<div class="modal fade" id="myModal'.$act.'">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">'.$date_d.' '.$date_click.'</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;
                        </button>
                      </div>

                      <div class="modal-body" ng-app="dateInputExample">';


        for ($i=0; $i<sizeof($sched_cal); $i++) {

            if ($sched_cal[$i]["telp_flag"] == 0 && $sched_cal[$i]["act"] == $date) {
                $week .=    '<div class="row">
                                  <div class="col-4 col-md-4 col-md-offset-12 reminder-title-sch">
                                    <span class="reminder-title-sch-type-call">CALL</span><br>
                                    <span class="reminder-title-sch-time">'.$sched_cal[$i]["time"].'</span>
                                  </div>
                                  <div class="col-8 col-md-8 col-md-offset-12 reminder-body-customer">
                                    <span class="reminder-body-customer-name">'.$sched_cal[$i]["name"].'</span><br>
                                    <span class="reminder-body-customer-telp">'.$sched_cal[$i]["telp_no"].'</span>
                                  </div>
                                </div>
                                <div>
                                  <hr style="margin: 0px;">
                                  <span>Note : '.$sched_cal[$i]["notes"].'</span>
                                </div>';
            } elseif ($sched_cal[$i]["telp_flag"] == 1 && $sched_cal[$i]["act"] == $date) {
                $week .=  '<div class="row">
                                  <div class="col-4 col-md-4 col-md-offset-12 reminder-title-sch">
                                    <span class="reminder-title-sch-type-appt">APPT</span><br>
                                    <span class="reminder-title-sch-time">'.$sched_cal[$i]["time"].'</span>
                                  </div>
                                  <div class="col-8 col-md-8 col-md-offset-12 reminder-body-customer">
                                    <span class="reminder-body-customer-name">'.$sched_cal[$i]["name"].'</span><br>
                                    <span class="reminder-body-customer-telp">'.$sched_cal[$i]["street"].', '.$sched_cal[$i]["kelurahan"].', '. $sched_cal[$i]["district"].'</span>
                                  </div>
                                </div>
                                <div>
                                  <hr style="margin: 0px;">
                                  <span>Note : '.$sched_cal[$i]["notes"].'</span>
                                </div>';
            }

        }
        $week .= '
                      </div>
                  </div>
                </div>
              </div>';
      }

    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>'.$week.'</tr>';

        // Prepare for new week
        $week = '';

    }

}

?>

<style type="text/css">
  .calendar-style-table th:nth-of-type(1),td:nth-of-type(1){
  color: red;
}

.calendar-style-table th:nth-of-type(7),td:nth-of-type(7){
  color: #134D72;
}

.modal-title {
  padding-left: 160px;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

        @if($role == 'salesperson')
        <div class="row batas">
        <div class="col-sm-6 col-md-8 col-md-offset-12">
            <div class="container reminder-layout">
              <div class="reminder-form">
                <div class="row reminder-title">
                  <div class="col-sm-6 col-md-12 col-md-offset-12">
                    Salesperson Statistics
                  </div>
                </div>
                <div class="row reminder-body">
                  <div class="container">
                    <canvas id="chartSalesperson" height="100" width="200"></canvas>
                    <script>
                      var ctx = document.getElementById("chartSalesperson").getContext('2d');
                      var myChart = new Chart(document.getElementById("chartSalesperson"), {
                        type: 'line',
                        data: {
                          labels: @json($labels),
                          datasets: @json($dataSales)
                        },

                        options: {
                          title: {
                            display: true,
                            text: 'Salesperson'
                          }
                        }
                      });
                    </script>
                  </div>
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
                  <div class="col-sm-6 col-md-12 col-md-offset-12 calendar-style">
                    <div class="row calendar-style-title">
                      <div class="col-2 col-md-2 col-md-offset-12">
                        <form method="GET" action="/palsystem/public/dashboard">
                          <input type="hidden" name="ym" value="<?php echo $prev; ?>" />
                          <button type="submit" class="btn">&lt;</button>
                        </form>
                      </div>
                      <div class="col-8 col-md-8 col-md-offset-12">
                        <?php echo $html_title; ?>
                      </div>
                      <div class="col-2 col-md-2 col-md-offset-12">
                        <form method="GET" action="/palsystem/public/dashboard">
                          <input type="hidden" name="ym" value="<?php echo $next; ?>" />
                          <button type="submit" class="btn">&gt;</button>
                        </form>
                      </div>
                    </div>
                    <center>
                    <table class="table table-bordered calendar-style-table">
                      <thead class="thead-light">
                        <tr>
                          <th>SUN</th>
                          <th>MON</th>
                          <th>TUE</th>
                          <th>WED</th>
                          <th>THU</th>
                          <th>FRI</th>
                          <th>SAT</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach ($weeks as $week) {
                                echo $week;
                            }
                        ?>
                      </tbody>
                    </table>
                    </center>
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
                    Product Statistics
                  </div>
                </div>
                <div class="row reminder-body">
                  <div class="container">
                    <canvas id="myChart" width="400" height="200"></canvas>
                    <script>
                      var ctx = document.getElementById("myChart").getContext('2d');
                      var myChart = new Chart(document.getElementById("myChart"), {
                          type: 'line',
                          data: {
                            labels: @json($labels),
                            datasets: @json($data)
                          },
                          options: {
                            title: {
                              display: true,
                              text: 'Product'
                            }
                          }
                        });
                    </script>
                  </div>
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
                <div class="reminder-body">
                  <div class="clockStyle">Server : <span id="clockDisplay"></span></div>
                  <div class="row reminder-body-list">
                    <div class="col-sm-6 col-md-12 col-md-offset-12">
                      <ul class="demo">
                        @for ($i=0; $i<sizeof($schedules); $i++)
                          <hr style="padding: 0px; margin-left: 0px; border-width: 2px; background-color: #D5D5D5;" width="100%">
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
                                          <input type="hidden" name="id" value="{{$schedules[$i]['id']}}">
                                          <input type="hidden" name="id_customer" value="{{$schedules[$i]['id_customer']}}">
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
                        @endfor
                        <hr style="padding: 0px; margin-left: 0px; border-width: 2px; background-color: #D5D5D5;" width="100%">
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
        </div>
        @endif

        @if($role == 'branch_manager')
        <div class="row batas">
          <div class="col-sm-6 col-md-8 col-md-offset-12">
            <div class="container reminder-layout">
              <div class="reminder-form">
                <div class="row reminder-title">
                  <div class="col-sm-6 col-md-12 col-md-offset-12">
                    Salesperson Statistics
                  </div>
                </div>
                <div class="row reminder-body">
                  <div class="container">
                    <canvas id="chartSalesperson" height="100" width="200"></canvas>
                    <script>
                      var ctx = document.getElementById("chartSalesperson").getContext('2d');
                      var myChart = new Chart(document.getElementById("chartSalesperson"), {
                        type: 'line',
                        data: {
                          labels: @json($labels),
                          datasets: @json($dataSales)
                        },

                        options: {
                          title: {
                            display: true,
                            text: 'Salesperson'
                          }
                        }
                      });
                    </script>
                  </div>
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
                  <div class="col-sm-6 col-md-12 col-md-offset-12 calendar-style">
                    <div class="row calendar-style-title">
                      <div class="col-2 col-md-2 col-md-offset-12">
                        <form method="GET" action="/palsystem/public/dashboard">
                          <input type="hidden" name="ym" value="<?php echo $prev; ?>" />
                          <button type="submit" class="btn">&lt;</button>
                        </form>
                      </div>
                      <div class="col-8 col-md-8 col-md-offset-12">
                        <?php echo $html_title; ?>
                      </div>
                      <div class="col-2 col-md-2 col-md-offset-12">
                        <form method="GET" action="/palsystem/public/dashboard">
                          <input type="hidden" name="ym" value="<?php echo $next; ?>" />
                          <button type="submit" class="btn">&gt;</button>
                        </form>
                      </div>
                    </div>
                    <center>
                    <table class="table table-bordered calendar-style-table">
                      <thead class="thead-light">
                        <tr>
                          <th>SUN</th>
                          <th>MON</th>
                          <th>TUE</th>
                          <th>WED</th>
                          <th>THU</th>
                          <th>FRI</th>
                          <th>SAT</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach ($weeks as $week) {
                                echo $week;
                            }
                        ?>
                      </tbody>
                    </table>
                    </center>
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
                    Product Statistics
                  </div>
                </div>
                <div class="row reminder-body">
                  <div class="container">
                    <canvas id="myChart" width="400" height="200"></canvas>
                    <script>
                      var ctx = document.getElementById("myChart").getContext('2d');
                      var myChart = new Chart(document.getElementById("myChart"), {
                          type: 'line',
                          data: {
                            labels: @json($labels),
                            datasets: @json($data)
                          },
                          options: {
                            title: {
                              display: true,
                              text: 'Product'
                            }
                          }
                        });
                    </script>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-4 col-md-offset-12">
            <div class="container reminder-layout">
              <div class="reminder-form">
                <div class="row reminder-title">
                  <div class="col-sm-6 col-md-12 col-md-offset-12">
                    Rating
                  </div>
                </div>
                <div class="row reminder-body">
                <div class="container">
                  <ul class="demo">
                    <li>
                      <h4>SalesPersons</h4>
                    </li>
                    @foreach ($listRatingSls as  $listRatingSls)
                    <li>
                      {{$listRatingSls['name']}} {{$listRatingSls['year']}} <img class="riwayat-icon" src="{{ url('image/rating.png') }}" alt="icon name">
                    </li>
                    @endforeach
                    <hr style="padding: 0px; margin-left: 0px; border-width: 2px; background-color: #D5D5D5;" width="100%">
                    <li>
                      <h4>Products</h4>
                    </li>
                    @foreach ($listRatingProd as  $listRatingProd)
                    <li>
                      {{$listRatingProd['name']}} {{$listRatingProd['year']}} <img class="riwayat-icon" src="{{ url('image/rating.png') }}" alt="icon name">
                    </li>
                    @endforeach
                  </ul>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif


          @if($role == 'regional_manager')
          <div class="row batas">
          <div class="col-sm-6 col-md-8 col-md-offset-12">
            <div class="container reminder-layout">
              <div class="reminder-form">
                <div class="row reminder-title">
                  <div class="col-sm-6 col-md-12 col-md-offset-12">
                    Product Statistics
                  </div>
                </div>
                <div class="row reminder-body">
                  <div class="container">
                    <canvas id="myChart" width="400" height="200"></canvas>
                    <script>
                      var ctx = document.getElementById("myChart").getContext('2d');
                      var myChart = new Chart(document.getElementById("myChart"), {
                        type: 'line',
                        data: {
                          labels: @json($labels),
                          datasets: @json($data)

                        },
                        options: {
                          title: {
                            display: true,
                            text: 'Product'
                          }
                        }
                      });
                    </script>
                  </div>
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
                  <div class="col-sm-6 col-md-12 col-md-offset-12 calendar-style">
                    <div class="row calendar-style-title">
                      <div class="col-2 col-md-2 col-md-offset-12">
                        <form method="GET" action="/palsystem/public/dashboard">
                          <input type="hidden" name="ym" value="<?php echo $prev; ?>" />
                          <button type="submit" class="btn">&lt;</button>
                        </form>
                      </div>
                      <div class="col-8 col-md-8 col-md-offset-12">
                        <?php echo $html_title; ?>
                      </div>
                      <div class="col-2 col-md-2 col-md-offset-12">
                        <form method="GET" action="/palsystem/public/dashboard">
                          <input type="hidden" name="ym" value="<?php echo $next; ?>" />
                          <button type="submit" class="btn">&gt;</button>
                        </form>
                      </div>
                    </div>
                    <center>
                    <table class="table table-bordered calendar-style-table">
                      <thead class="thead-light">
                        <tr>
                          <th>SUN</th>
                          <th>MON</th>
                          <th>TUE</th>
                          <th>WED</th>
                          <th>THU</th>
                          <th>FRI</th>
                          <th>SAT</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach ($weeks as $week) {
                                echo $week;
                            }
                        ?>
                      </tbody>
                    </table>
                    </center>
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
                    Salesperson Statistics
                  </div>
                </div>
                <div class="row reminder-body">
                  <div class="container">  
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
        @endif

          @if($role == 'group_head')
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
                  <div class="container">
                    <canvas id="myChart" width="400" height="200"></canvas>
                    <script>
                      var ctx = document.getElementById("myChart").getContext('2d');
                      var myChart = new Chart(document.getElementById("myChart"), {
                        type: 'line',
                        data: {
                          labels: @json($labels),
                          datasets: @json($data)

                        },
                        options: {
                          title: {
                            display: true,
                            text: 'Product'
                          }
                        }
                      });
                    </script>
                  </div>
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
                  <div class="col-sm-6 col-md-12 col-md-offset-12 calendar-style">
                    <div class="row calendar-style-title">
                      <div class="col-2 col-md-2 col-md-offset-12">
                        <form method="GET" action="/palsystem/public/dashboard">
                          <input type="hidden" name="ym" value="<?php echo $prev; ?>" />
                          <button type="submit" class="btn">&lt;</button>
                        </form>
                      </div>
                      <div class="col-8 col-md-8 col-md-offset-12">
                        <?php echo $html_title; ?>
                      </div>
                      <div class="col-2 col-md-2 col-md-offset-12">
                        <form method="GET" action="/palsystem/public/dashboard">
                          <input type="hidden" name="ym" value="<?php echo $next; ?>" />
                          <button type="submit" class="btn">&gt;</button>
                        </form>
                      </div>
                    </div>
                    <center>
                    <table class="table table-bordered calendar-style-table">
                      <thead class="thead-light">
                        <tr>
                          <th>SUN</th>
                          <th>MON</th>
                          <th>TUE</th>
                          <th>WED</th>
                          <th>THU</th>
                          <th>FRI</th>
                          <th>SAT</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach ($weeks as $week) {
                                echo $week;
                            }
                        ?>
                      </tbody>
                    </table>
                    </center>
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
                    Salesperson Statistics
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
        </div>
          @endif

        <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        function renderTime() {
          var currentTime = new Date();
          var h = currentTime.getHours();
          var m = currentTime.getMinutes();
          var s = currentTime.getSeconds();

          if (h < 10) {
            h = "0" + h;
          }

          if (m < 10) {
            m = "0" + m;
          }

          if (s < 10) {
            s = "0" + s;
          }

          var myClock = document.getElementById('clockDisplay');
          myClock.textContent = h + ":" + m + ":" + s;
          setTimeout('renderTime()', 1000);
        }

        renderTime();
        </script>
@endsection
