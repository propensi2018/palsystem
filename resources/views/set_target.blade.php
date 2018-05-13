@extends('layouts.master')

@section('title', 'Create Appointment')

@section('contents')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

          <div id="divTarget" class="form-group row">
            <label class="control-label col-sm-6 col-md-4 col-md-offset-12 appt-form-name" for="amount"><h5>Target* :</h5></label>
            <h5>Rp</h5><input pattern="\$?\d+(\,\d{2})?$" oninvalid="this.setCustomValidity('Please enter valid amount')" required id="amount0" class="form-control col-sm-6 col-md-4 col-md-offset-12" name="amount0" type="text" placeholder="" />
          </div>
        </div>
      </div>

      <div id="next_app" class="form-group row">
        <label class="control-label col-sm-6 col-md-4 col-md-offset-12 appt-form-name" for="next_app"><h5>For : </h5></label>
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
  // var product_types = @json($product_types);
  // var total_product = 0;
  // $('#adder').click(function(){
  //   total_product += 1;
  //   $('#total_product').val(total_product + 1);
  //   if (total_product == 1) {
  //     $('#deleter').show();
  //   }
  //   //alert(total_product);
  //   var added = $("#product0").clone();
  //   var newid = 'product' + total_product;
  //   added.find('input').val("");
  //   added.attr('id', newid);
  //   // var test = added.find('#amount0').id();
  //   added.appendTo("#product_container");
  //   $('#' + newid).find('select')
  //     .attr('name','product_type' + total_product)
  //     .attr('id','product_type' + total_product);
  //   $('#' + newid).find('input')
  //     .attr('name','amount' + total_product)
  //     .attr('id','amount' + total_product);
  //     // alert('bewear');
  //     // refresh();
  //   //console.log([newid, id_class]);
  // });
  // $('#deleter').click(function(){
  //   //alert(total_product);
  //   $('#product' + total_product).remove();
  //   total_product -= 1;
  //   $('#total_product').val(total_product + 1);
  //   // refresh();
  //   if (total_product <= 0) {
  //     $('#deleter').hide();
  //   }
  // });
  // // $('select').change(refresh());
  //
  // $('#failure').change(
  //   function () {
  //     if ($('#failure').val() == 0) {
  //       $('#next_app').hide();
  //       $('#next_app').removeAttr();
  //     } else {
  //       $('#next_app').show();
  //       $('#next_app').attr('required', '');
  //     }
  //   }
  // );
  //
  // $('div select[name=appointment_type]').change(function(){
  //   if ($('div select[name=appointment_type]').val() == '3'){
  //     $('#next_app').find('input').removeAttr('required');
  //     $('#next_app').hide();
  //     // $('#notes').hide();
  //     $('#failure-container').hide();
  //
  //     $('#product_container').find('input').removeAttr('required');
  //     $('#product_container').find('select').removeAttr('required');
  //     $('#product_container').hide();
  //
  //   } else if ($('div select[name=appointment_type]' ).val() == '1' ){
  //     $('#next_app').find('input').attr('required', '');
  //     $('#next_app').show();
  //     $('#failure-container').show();
  //
  //     $('#product_container').find('input').removeAttr('required');
  //     $('#product_container').find('select').removeAttr('required');
  //     $('#product_container').hide();
  //   } else {
  //     $('#next_app').find('input').attr('required', '');
  //     $('#next_app').show();
  //     $('#failure-container').hide();
  //
  //     $('#product_container').find('input').attr('required', '');
  //     $('#product_container').find('select').attr('required', '');
  //     $('#product_container').show();
  //
  //   }
  //
  // });
</script>


@endsection
