<?php
session_start();
?>

@extends('layouts.master')
@section('title', 'Customer')
@section('contents')

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.0-beta.5/angular.min.js"></script>

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
            <th>Nominal</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
          </tr>
        </tbody>

      </table>
    </div>

  </div>
</div>
@endsection