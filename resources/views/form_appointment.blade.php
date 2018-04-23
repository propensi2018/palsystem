
@extends('layouts.master')

@section('title', 'Create Appointment')

@section('contents')
<div class="container-fluid row">
  <div class="border col-sm-3 rounded" style="margin-top: 5%; margin-left: 5%; padding-top: 10px; padding-bottom: 10px">

    <form class="form-horizontal" action="store" method='post'>
      {{ csrf_field() }}
      <div class="form-group row">
        <label class="control-label col-sm-5" for="appointment_type">Appointment : </label>
        <select class="form-control col-sm-6" name="appointment_type">
          @foreach($activity_types as $activity_type)
            <option value='{{$activity_type->id}}'>{{$activity_type->name}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="notes">Notes : </label>
        <textarea class="form-control col-sm-11" style="margin-left: 2%" rows="5" placeholder="Insert notes here..." name="notes"></textarea>
      </div>

      <div class="form-group row">
        <label class="control-label col-sm-5" for="product_list">Product List : </label>
        <select id="product_list" class="form-control col-sm-6" name="product_type">
          @foreach($product_types as $product_type)
            <option>{{$product_type->desc}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group row">
        <label class="control-label col-sm-5" for="amount">Amount : </label>
        <input class="form-control col-sm-6" name="amount" type="number" >
      </div>

      <input name="customer_id" type="hidden" value="{{$customer->id}}">
      <input name="submit" class="btn" type="submit" value="Submit Appointment">
    </form>

  </div>

  <div id="uc" class="col-sm-3" style="margin-top: 15%" align="center">
      <form>
          <input id="iUC" type="button" class="btn " value="Generate Unique Code" onclick="window.location.href='generateUC'" />
      </form>
  </div>
</div>
@endsection -->
<form action="store" method='post'>
  {{ csrf_field() }}
  <label for="appointment_type">Appointment</label>
  <select name="appointment_type">
    @foreach($activity_types as $activity_type)
      <option value='{{$activity_type->id}}'>{{$activity_type->name}}</option>
    @endforeach
  </select>
  <br>

  <label for="notes">Notes</label>
  <textarea name="notes"></textarea>
  <br>

  <label for="product_list">Product List</label>
  <select id="product_list" class="custom-select col-8 col-sm-9" name="product_type">
    @foreach($product_types as $product_type)
      <option>{{$product_type->desc}}</option>
    @endforeach
  </select>
  <br>
  <label for="amount">Amount</label>
  <input name="amount" type="number">
  <br>

  <input name="customer_id" type="hidden" value="{{$customer->id}}">
  <input name="submit" type="submit" value="Submit Appointment">

</form>
