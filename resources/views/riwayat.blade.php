<?php
session_start();
?>

@extends('layouts.master')
@section('title', 'Customer')
@section('contents')

<div class="riwayat">
  <div class="container">

    <h2 style="text-align: center"><b>SALESPERSON HISTORY</b></h2>

    <div data-role="page" ng-app="dateInputExample" class="data-table">
      <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>
          <tr>
            <th>Name</th>
            <th>Activity</th>
            <th>Time</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($salesperson_history as $history)
          <tr>
            <td>
              {{$history->name}}
            </td>
            <td>
              {{$history->telp_flag}}
            </td>
            <td>
              {{$history->time}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection
 