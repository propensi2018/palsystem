<?php
session_start();
?>

@extends('layouts.master')
@section('title', 'Profile')
@section('contents')

<div class="batas-riwayat">
  <div class="riwayat-layout">
    <div class="riwayat-form">
      <div class="riwayat-title">
          <h3>{{$salesperson->name}}
            @for ($i = 0; $i < $amountRating ; $i++)
                  <img class="riwayat-icon" src="{{ url('image/rating.png') }}" alt="icon name">
              @endfor
          </h3>
          <h5>ID : {{$salesperson->id_sp}}</h5>

              
      </div>
      <div class="riwayat-body">
        <h2 style="text-align: center; margin-top: 10px"><b>HISTORY</b></h2>
        <div data-role="page" ng-app="dateInputExample" class="data-table">
          <table id="example" class="table table-striped table-bordered" style="width:100%; text-align: center">

            <thead>
              <tr>
                <th>Time</th>
                <th>Activity</th>
                <th>Cutomer Name</th>
                <th>Detail</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($salesperson_history as $history)
              <tr>
                <td>
                  {{$history->created_at}}
                </td>
                @if (is_null($history->response))
                  <td>
                    Appointment
                  </td>
                @else
                  <td>
                    Call
                  </td>
                @endif
                <td>
                  {{$history->name}}
                </td>
                @if (is_null($history->response))          
                  <td>
                    <a href="history/appointment/{{$history->id}}" class="btn btn-primary">Detail</a>
                  </td>
                @else
                  <td>
                    <a href="history/call/{{$history->id}}" class="btn btn-primary">Detail</a>
                  </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
      $('#example').DataTable( {
          "order": [[ 0, "desc" ]]
      } );
  } );
</script>

@endsection
