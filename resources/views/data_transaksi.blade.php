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

    <!-- <div class="row"> -->
    <br>
    <form method="GET" action="/palsystem/public/dataTransaksi">
      <select name="month">

        <option value="All">All</option>        
        <option value="1" {{ $month == 1 ? "selected":"" }}>January</option>
        <option value="2" {{ $month == 2 ? "selected":"" }}>February</option>
        <option value="3" {{ $month == 3 ? "selected":"" }}>March</option>
        <option value="4" {{ $month == 4 ? "selected":"" }}>April</option>
        <option value="5" {{ $month == 5 ? "selected":"" }}>May</option>
        <option value="6" {{ $month == 6 ? "selected":"" }}>June</option>
        <option value="7" {{ $month == 7 ? "selected":"" }}>July</option>
        <option value="8" {{ $month == 8 ? "selected":"" }}>August</option>
        <option value="9" {{ $month == 9 ? "selected":"" }}>September</option>
        <option value="10" {{ $month == 10 ? "selected":"" }}>October</option>
        <option value="11" {{ $month == 11 ? "selected":"" }}>November</option>
        <option value="12" {{ $month == 12 ? "selected":"" }}>December</option>

      </select>
      <select name="year">
        @foreach ($yearArray as $yearOpt)
        <option value="{{$yearOpt}}"> {{$yearOpt}}</option>
        @endforeach
      </select>

      <button type="submit" class="btn btn-primary">View</button>
    </form>

        <form method="get" action="dataTransaksi/print_PDF">
        @if(!empty($month) && !empty($year))
          <input type="hidden" name="month"  value="{{$month}}">
          <input type="hidden" name="year"  value="{{$year}}">
        @endif
        <button type="submit" class="btn btn-primary float-right">Print</button>
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
    <!-- <a href="dataTransaksi/print_PDF">print</a> -->
    </div>
  </div>
</div>

@endsection