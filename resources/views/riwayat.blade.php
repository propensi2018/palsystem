<?php
session_start();
?>

@extends('layouts.master')
@section('title', 'Profile')
@section('contents')

<div class="riwayat">
  <div class="container">
    <div style="background-color: blue; margin-top: 30px;border-radius: 5px">
        <h3 style="color: white; margin-left: 20px; padding-top: 10px">{{$salesperson->name}}</h3>
        <h5 style="color: white; margin-left: 20px; padding-bottom: 10px">ID : {{$salesperson->id_sp}}</h5>
<<<<<<< HEAD
            @for ($i = 0; $i < $amountRating ; $i++)
                <a>*</a>
            @endfor

=======
        @for ($i = 0; $i < $amountRating ; $i++)
            <a>*</a>
        @endfor
>>>>>>> 9a0c1219dbc99a9aac601690f6407713fe517540
    </div>
    <h2 style="text-align: center; margin-top: 10px"><b>HISTORY</b></h2>
    <div data-role="page" ng-app="dateInputExample" class="data-table">
      <table id="example" class="table table-striped table-bordered" style="width:100%; text-align: center">

        <thead>
          <tr>
            <th>Time</th>
            <th>Activity</th>
            <th>Name</th>
            <th>Detail</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($salesperson_history as $history)
          <tr>
            <td>
              {{$history->created_at}}
            </td>
            @if ($history->telp_flag === 0)
              <td>
                Call
              </td>
            @elseif ($history->telp_flag === 1)
              <td>
                Appointment
              </td>
            @endif
            <td>
              {{$history->name}}
            </td>
            <td>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="">Detail</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection
