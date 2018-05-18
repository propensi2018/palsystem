<!DOCTYPE html>
<html lang="en">

<head>
{{--
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<!-- 
    <title>PAL - @yield('title')</title> -->

    <base href="{{ URL::asset('/') }}" target="_blank"></base>
    <!-- Bootstrap core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/datatables.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ url('css/sidebars.css') }}" rel="stylesheet">
    <link href="{{ url('css/navbars.css') }}" rel="stylesheet">
    <link href="{{ url('css/dashboardsss.css') }}" rel="stylesheet">
    <link href="{{ url('css/messages.css') }}" rel="stylesheet">
    <link href="{{ url('css/achsani.css') }}" rel="stylesheet">
    <link href="{{ url('css/customers_prospects.css') }}" rel="stylesheet">
    <link href="{{ url('css/profile-appointment.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('./slick/slicks.css') }}">
    <link rel="stylesheet" href="{{ url('./slick/slick-themes.css') }}">

    <script type="text/javascript" src="{{ url('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/datatables.min.js') }}"></script>--}}

    <style>
    table, td, th {
        border: 1px solid black;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th {
        height: 50px;
    }
    #amount-css {
        text-align: right;
    }
    </style>
</head>

<body style="background-color: #fff;">

<div class="data_transaksi">
  <div class="container">

    <h2 style="text-align: center"><b>TRANSACTION DATA</b></h2>

    <p>Month:{{$month}} - Year:{{$year}}</p>
    <div data-role="page" ng-app="dateInputExample" class="data-table">
      <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>
          <tr>
            <th>No.</th>
            <th>Customer's Name</th>
            <th>Costumer's Address</th>
            <th>Product</th>
            <th>Telephone(s)</th>
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
              {{$data -> street}} {{$data -> city}} {{$data -> postal_code}}
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
    </div>
  </div>
</div>
</body>
