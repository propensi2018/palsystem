<?php
session_start();
?>

@extends('layouts.master')
@section('title', 'Customer')
@section('contents')

<div class="data_transaksi">
  <div class="container">

    <h2 style="text-align: center"><b>TRANSACTION DATA</b></h2>
  <!-- <div class="row" style="float: right;">
    <div class="dropdown">
      <select type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <option value="1">January</option>
        <option value="2">February</a>
        <option value="3">March</a>
        <option value="4">April</a>
        <option value="5">May</a>
        <option value="6">June</a>
        <option value="7">July</a>
        <option value="8">August</a>
        <option value="9">September</a>
        <option value="10">October</a>
        <option value="11">November</a>
        <option value="12">December</a>
      </select>
    </div>

    <div class="dropdown">
      <select type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <option value="2018">2018</option>
      </select>
    </div>
  </div> -->


    <form method="GET" action="/dataTransaksi">
      <select name="month">
        <option value="1">January</option>
        <option value="2">February</a>
        <option value="3">March</a>
        <option value="4">April</a>
        <option value="5">May</a>
        <option value="6">June</a>
        <option value="7">July</a>
        <option value="8">August</a>
        <option value="9">September</a>
        <option value="10">October</a>
        <option value="11">November</a>
        <option value="12">December</a>
      </select>
      <select name="year">
        <option value="2018">2018</option>
      </select>
      <button type="submit">view</button>
    </form>

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
                @if (!$loop->first)
                  ,
                @endif
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
      <form method="get" action="dataTransaksi/print_PDF">
        @if(!empty($month) && !empty($year))
          <input type="hidden" name="month"  value="{{$month}}">
          <input type="hidden" name="year"  value="{{$year}}">
        @endif
        <button type="submit" >print</button>
      </form>
    <!-- <a href="dataTransaksi/print_PDF">print</a> -->
    </div>
  </div>
</div>

@endsection