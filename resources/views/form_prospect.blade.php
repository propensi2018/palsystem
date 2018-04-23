
@extends('layouts.master')
@section('title', 'Form-Prospect')
@section('contents')

<div class="container" id=''>
  <div class="customer-form">
      <h2><b>CUSTOMER INFORMATION FORM</b></h2>
  </div>
  <form method="POST" action="prospect/StoreProspect"> {{ csrf_field() }}
    <div class="form-group">
      <label>Province :</label>
      <input name="provinsi" type="text" class="form-control" id="provinsi" aria-describedby="emailHelp" placeholder="Enter the province"  minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
      
    </div>
    <div class="form-group">
      <label>City :</label>
      <input type="text" name="kota" class="form-control" id="kota" placeholder="Enter the city name" minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
    </div>
    <div class="form-group">
      <label >Village :</label>
      <input name="kelurahan" type="text" class="form-control" id="kelurahan" placeholder="Enter the village name" minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
    </div>
      <div class="form-group">
      <label >Sub-District :</label>
      <input name="kecamatan" type="text" class="form-control" id="kecamatan" placeholder="Enter the sub-district name" minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
    </div>
    <div class="form-group">
      <label >Postal Code :</label>
      <input name="kodePos" type="text" class="form-control" id="kodePos" placeholder="Enter the postal code number" minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
    </div>
    <div class="form-group">
      <label>Street Name :</label>
      <input name="namaJalan" type="text" class="form-control" id="namaJalan" placeholder="Enter the street name" minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
    </div>
    <input type="submit" class="btn btn-primary" data-inline="true" value="Submit">
    <input type="hidden" name='id_customer' value="{{ $strSch -> id_customer }}">
    <input type="hidden" name='notes' value="{{ $strSch -> notes }}">
  </form>
</div>

@endsection
