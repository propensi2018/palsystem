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
  </div>
</div>


@endsection
