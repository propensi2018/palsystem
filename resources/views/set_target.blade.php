@extends('layouts.master')

@section('title', 'Create Appointment')

@section('contents')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
function addCommas(nStr)
  {
  	nStr += '';
  	x = nStr.split('.');
  	x1 = x[0];
  	x2 = x.length > 1 ? '.' + x[1] : '';
  	var rgx = /(\d+)(\d{3})/;
  	while (rgx.test(x1)) {
  		x1 = x1.replace(rgx, '$1' + ',' + '$2');
  	}
  	return x1 + x2;
  }
  $(document).ready(function(){
    var amounts = $('#product_container').find('input');
    amounts.change(function(){
      var val = amounts.val();
      // console.log(val);
      amounts.val(addCommas(val));
    });
  });
</script>
<div class="profile-customer">
  <ul class="nav nav-tabs nav-appt">
        <li id="tab-1" class="nav-item">
        </li>
        <li id="tab-2" class="nav-item">
            <a id="nav-tulisan" id="navbar-active" class="nav-link nav-appt-active">PRODUCT</a>
        </li>
    </ul>
  <div class="card-appt">
    <form class="form-horizontal" action="setTarget/product/store" method='post'>
      {{ csrf_field() }}

      <div id="divProductList" class="form-group row">
        <label><h5>Setting Target for 20{{$today}}</h5></label>
      </div>

        <div id="product0">
          <div id="divProductList" class="form-group row">
            <label class="control-label col-sm-6 col-md-4 col-md-offset-12 appt-form-name" for="product_list"><h5>Product : </h5></label>
            <select required id="product_type0" class="form-control col-sm-6 col-md-4 col-md-offset-12" name="product_type0">
               <option disabled selected value> -- select an option -- </option>
               @foreach($product_types as $pt)
                <option value="{{$pt->id}}">{{$pt->desc}}</option>
               @endforeach
             </select>
          </div>

          <div id="divTarget" class="form-group row">
            <label class="control-label col-sm-6 col-md-4 col-md-offset-12 appt-form-name" for="target"><h5>Target :</h5></label>
            <input pattern="\$?\d+(\,\d{2})?$"  required id="target" class="form-control col-sm-6 col-md-4 col-md-offset-12" name="target" type="text" placeholder="" />
          </div>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-4 col-md-offset-12">
        </div>
        <div class="col-sm-12 col-md-4 col-md-offset-12">
          <input class="btn btn-primary" type="submit" value="Submit Appointment" onclick="show_alert()">
        </div>
      </div>

  </div>
</div>

@endsection
