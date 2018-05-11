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
            <th>Telephone</th>
            <th>Amount</th>
          </tr>
        </thead>

        @php
          $i=1
        @endphp

        <tbody>
          @foreach ($TransData as $data)
          <tr>
            <td>
              {{$i++}}
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
              @foreach (
              $data -> telephones as $telp)
              {{$telp -> telp_no}}
              @endforeach
            </td>
            <td>
              {{number_format($data -> amount,0,'','.')}}
            </td>
          </tr>
          @endforeach
        </tbody>

      </table>
    <a href="dataTransaksi/print_PDF">print</a>
    </div>
  </div>
</div>

@endsection