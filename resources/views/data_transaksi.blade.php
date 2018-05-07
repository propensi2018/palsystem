<?php
session_start();
?>

@extends('layouts.master')
@section('title', 'Customer')
@section('contents')

<div class="data_transaksi">
  <div class="container">

    <h2 style="text-align: center"><b>TRANSACTION DATA</b></h2>

    <div data-role="page" ng-app="dateInputExample" class="data-table">
      <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>
          <tr>
            <th>No.</th>
            <th>Customer's Name</th>
            <th>Costumer's Address</th>
            <th>Product(s)</th>
            <th>Amount</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($TransData as $data)
          <tr>
            <td>
              1
            </td>
            <td>
              {{$data -> name}}
            </td>
            <td>
              {{$data -> city}}
            </td>
            <td>
              {{$data -> desc}}
            </td>
            <td>
              {{$data -> amount}}
            </td>
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>
  </div>
</div>

@endsection