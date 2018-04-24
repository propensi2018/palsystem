@extends('layouts.master')

@section('title', 'Create Appointment')

@section('contents')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../resources/assets/js/autoNumeric-next/src/AutoNumeric.js"></script>
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
            <a id="nav-tulisan" class="nav-link nav-appt-no-active" href="{{ URL::to('../public/customer/' . $customer_id)}}">CUSTOMER DATA</a>
        </li>
        <li id="tab-2" class="nav-item">
            <a id="nav-tulisan" id="navbar-active" class="nav-link nav-appt-active">APPOINTMENT</a>
        </li>
    </ul>
  <div class="card-appt">
    <form class="form-horizontal" action="appointment/store" method='post'>
      {{ csrf_field() }}

      <div class="form-group row">
        <label class="control-label col-sm-6 col-md-4 col-md-offset-12 appt-form-name" for="planned_date"><h5>Planned Time* : </h5></label>
        <p> {{$planned_date}} </p>
      </div>

      <div class="form-group row">
        <label class="control-label col-sm-6 col-md-4 col-md-offset-12 appt-form-name" for="actual_time"><h5>Actual Time* : </h5></label>
        <input required class="form-control col-sm-6 col-md-4 col-md-offset-12" name="actual_time" type="datetime-local" value="{{$today}}">
      </div>

      <div class="form-group row">
        <label class="control-label col-sm-6 col-md-4 col-md-offset-12 appt-form-name" for="appointment_type"><h5>Appointment : </h5></label>
        <select class="form-control col-sm-6 col-md-4 col-md-offset-12" name="appointment_type">
          @foreach($activity_types as $activity_type)
            <option value='{{$activity_type->id}}'>{{$activity_type->name}}</option>
          @endforeach
        </select>
      </div>
      <div id = "notes" class="form-group row">
        <label for="notes" class="col-sm-6 col-md-4 col-md-offset-12 appt-form-name"><h5>Notes* : </h5></label>
        <textarea type="text" class="form-control col-sm-6 col-md-4 col-md-offset-12" rows="5" id="notes" placeholder="Insert notes here..." name="notes"></textarea>
      </div>

      <br>

      <div class="form-group row">
        <div class="col-md-4 col-md-offset-12">
        </div>
        <div class="col-sm-12 col-md-8 col-md-offset-12">
          <button id ='adder' type='button' class="btn btn-secondary">Add More Product</button>
          <button id ='deleter' type='button' style = 'display: none' class="btn btn-danger">Delete More Product</button>
        </div>
      </div>

      <div id="product_container">
        <div id="product0">
          <div id="divProductList" class="form-group row">
            <label class="control-label col-sm-6 col-md-4 col-md-offset-12 appt-form-name" for="product_list"><h5>Product* : </h5></label>
            <select id="product_type0" class="form-control col-sm-6 col-md-4 col-md-offset-12" name="product_type0">
               <option required disabled selected value> -- select an option -- </option>
              @foreach($product_types as $product_type)
                <option class='{{$product_type -> id}}' value="{{$product_type->id}}">{{$product_type->desc}}</option>
              @endforeach
            </select>
          </div>

          <div id="divAmount" class="form-group row">
            <label class="control-label col-sm-6 col-md-4 col-md-offset-12 appt-form-name" for="amount"><h5>Amount* :</h5></label>
            <h5>Rp</h5><input pattern="\$?\d+(\,\d{2})?$" oninvalid="this.setCustomValidity('Please enter valid amount')" required id="amount0" class="form-control col-sm-6 col-md-4 col-md-offset-12" name="amount0" type="text" placeholder="" />
          </div>
        </div>
      </div>

      <div id="next_app" class="form-group row">
        <label class="control-label col-sm-6 col-md-4 col-md-offset-12 appt-form-name" for="next_app"><h5>Next Appointment* : </h5></label>

        <input id="total_product" type="hidden" val="1">

        <input required class="form-control col-sm-6 col-md-4 col-md-offset-12" min={{$today}} name="next_app" type="datetime-local" placeholder="example : 01/01/2001 00:00">
      </div>

      <br>

      <div class="form-group row">
        <div class="col-md-4 col-md-offset-12">
        </div>
        <div class="col-sm-12 col-md-4 col-md-offset-12">
          <input name="unique_code" type="hidden" value="345901">
          <input name="customer_id" type="hidden" value="{{$customer->id}}">
          <p>*) Required</p>
          <input class="btn btn-primary" type="submit" value="Submit Appointment" onclick="show_alert()">
        </div>
      </div>

  </div>
</div>


<script>
  var product_types = @json($product_types);

  // function refresh(){
  //   var product_types_selected = [];
  //   var i = 0;
  //   while (i < total_product){
  //     console.log([i, total_product]);
  //     var val = $('#product_type' + i).val();
  //     product_types_selected.push(val);
  //     // console.log(val);
  //     i++;
  //     console.log(product_types_selected);
  //   }
  //   product_types_selected.forEach(function(item) {
  //     $('#product_type' + 0).find('.' + item).remove();
  //   });
  // }

  $('#adder').click(function(){
    total_product += 1;
    $('#total_product').val(total_product + 1);
    if (total_product == 1) {
      $('#deleter').show();
    }
    //alert(total_product);
    var added = $("#product0").clone();
    var newid = 'product' + total_product;
    added.find('input').val("");
    added.attr('id', newid);
    // var test = added.find('#amount0').id();
    added.appendTo("#product_container");
    $('#' + newid).find('select')
      .attr('name','product_type' + total_product)
      .attr('id','product_type' + total_product);
    $('#' + newid).find('input')
      .attr('name','amount' + total_product)
      .attr('id','amount' + total_product);
      // alert('bewear');
      // refresh();
    //console.log([newid, id_class]);
  });
  $('#deleter').click(function(){
    //alert(total_product);
    $('#product' + total_product).remove();
    total_product -= 1;
    $('#total_product').val(total_product + 1);
    // refresh();
    if (total_product <= 0) {
      $('#deleter').hide();
    }
  });
  // $('select').change(refresh());
  $('div select[name=appointment_type]').change(function(){
    if ($('div select[name=appointment_type]').val() == '4'){
      $('#next_app').find('input').removeAttr('required');
      $('#next_app').hide();
      $('#notes').hide();
    } else if ($('div select[name=appointment_type]').val() == '1' || $('div select[name=appointment_type]').val() == '2' || $('div select[name=appointment_type]').val() == '3'){
      $('#next_app').find('input').attr('required', '');
      $('#next_app').show();
      $('#notes').show();
  }});

</script>


@endsection
