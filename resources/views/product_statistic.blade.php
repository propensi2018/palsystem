@extends('layouts.master')

@section('title', 'Product Statistics')

@section('contents')
	<div class="row batas">
          <div class="col-sm-12 col-md-12 col-md-offset-12">
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
										Select period:
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection
