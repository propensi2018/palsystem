
@extends('layouts.master')
@section('title', 'Form-Prospect')
@section('contents')

<div class="container" id=''>
  <div class="customer-form">
      <h2><b>CUSTOMER INFORMATION FORM</b></h2>
  </div>
<button data-toggle="collapse" data-target="#form">Collapsible</button>
    <form id="form" method="POST" action="prospect/StoreProspect"> {{ csrf_field() }}
   <div id="address_container">

      <div class="form-group">
        <label>Email :</label>
        <input class="form-control" type="text" name="email" id="email">
    </div>
<div id="address0">

    <div class="form-group">
        <label>Province :</label>
        <input name="provinsi0" type="text" class="form-control" id="provinsi0" aria-describedby="emailHelp" placeholder="Enter the province"  minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
    </div>
    <div class="form-group">
      <label>City :</label>
      <input type="text" name="kota0" class="form-control" id="kota0" placeholder="Enter the city name" minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
    </div>
    <div class="form-group">
      <label >Village :</label>
      <input name="kelurahan0" type="text" class="form-control" id="kelurahan0" placeholder="Enter the village name" minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
    </div>
      <div class="form-group">
      <label >Sub-District :</label>
      <input name="kecamatan0" type="text" class="form-control" id="kecamatan0" placeholder="Enter the sub-district name" minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
    </div>
    <div class="form-group">
      <label >Postal Code :</label>
      <input name="kodePos0" type="text" class="form-control" id="kodePos0" placeholder="Enter the postal code number" minlength='1' pattern="^[0-9\+\(\)]*$" oninvalid="this.setCustomValidity('Please Enter a Valid Postal Code Number')" oninput="setCustomValidity('')" required>
    </div>
    <div class="form-group">
      <label>Street Name :</label>
      <input name="namaJalan0" type="textarea" class="form-control" id="namaJalan0" placeholder="Enter the street name" minlength='1' oninvalid="this.setCustomValidity('Please Insert This Field Before You Submit')" oninput="setCustomValidity('')" required>
    </div>




</div>

    </div>
         <button id ='adder' type='button' class="btn btn-secondary">Add More Address</button>
          <button id ='deleter' type='button' style = 'display: none' class="btn btn-danger">Delete More Address</button>
        <input type="submit" class="btn btn-primary" data-inline="true" value="Submit">
        <input type="hidden" id="total_address" value="1">
        <!-- <input type="hidden" id="schedule_id" value="{{$strSch -> id}}"> -->
     <input type="hidden" name='id_customer' value="{{ $strSch -> id_customer }}">
    <input type="hidden" name='notes' value="{{ $strSch -> notes }}">

          </form>
</div>
<script>
$('#adder').click(function(){
    total_address =+ 1;
    $('#total_address').val(total_address + 1);
    if (total_address == 1) {
      $('#deleter').show();
    }
    //alert(total_product);
    var added = $("#address0").clone();
    var newid = 'address' + total_address;
    added.attr('id', newid);
    added.find('input').val("");
    // var test = added.find('#amount0').id();
    added.appendTo("#address_container");
    $('#' + newid).find('#provinsi0')
      .attr('name','provinsi' + total_address)
      .attr('id','provinsi' + total_address);
    $('#' + newid).find('#kota0')
      .attr('name','kota' + total_address)
      .attr('id','kota' + total_address);
    $('#' + newid).find('#kelurahan0')
      .attr('name','kelurahan' + total_address)
      .attr('id','kelurahan' + total_address);
    $('#' + newid).find('#kecamatan0')
      .attr('name','kecamatan' + total_address)
      .attr('id','kecamatan' + total_address);
    $('#' + newid).find('#kodePos0')
      .attr('name','kodePos' + total_address)
      .attr('id','kodePos' + total_address);
    $('#' + newid).find('#namaJalan0')
      .attr('name','namaJalan' + total_address)
      .attr('id','namaJalan' + total_address);
  });
    $('#deleter').click(function(){
    //alert(total_product);
    $('#address' + total_address).remove();
    total_address -= 1;
    $('#total_address').val(total_address+ 1);
    // refresh();
    if (total_address <= 0) {
      $('#deleter').hide();
    }
  });
</script>
@endsection
