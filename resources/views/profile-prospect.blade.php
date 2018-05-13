
@extends('layouts.master')
@section('title','Profile Customer')
@section('contents')

<div class="profile-customer">
    <ul class="nav nav-tabs nav-appt">
        <li id="tab-1" class="nav-item">
            <a id="nav-tulisan" id="navbar-active" class="nav-link nav-appt-active">CUSTOMER DATA</a>
        </li>
           @if($scheduleAppointmentId[0]->is_a_deal == 0)
        <li id="tab-2" class="nav-item">
            <a id="nav-tulisan" class="nav-link nav-appt-no-active" href="{{ URL::to('../public/appointment/' . $customerData->id)}}">APPOINTMENT</a>
        </li>
            @else
            @endif
    </ul>
    <div class="card-customer">
        <div class="card-customer-title">
            <h1 class="card-customer-title-name">{{$customerData->name}}</h1>
      
                
              @if($scheduleAppointmentId[0]->is_a_deal == 0)
                            
                                @else
                                   <button>Re-Approach</button>
                                @endif
          
             @if($customerType->name === 'Hot')
                    <span class='badge badge-danger'>{{$customerType->name}}</span>
                @else
                    <span class='badge badge-success'>{{$customerType->name}}</span>
                @endif
            <span class="badge badge-secondary">{{$pw->name}}</span>
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalWillingness">Change</button>
             <div class="modal fade" id="modalWillingness">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form method="post" action="/customer/willingnessResponse" >{{ csrf_field() }}
                        <div class="modal-header">
                        <h4 class="modal-title" style="color:black;">Change Prospect Willingness </h4>
                        </div>
                        <div class="modal-body">
                          <select name='selectWillingness' id="customer_type" class="custom-select col-8 col-sm-9" name="prospect_willingness">
                            <option value="3" <?php
                                    if($prospect[0]->prospect_willingness_id==3)
                                        echo 'selected="selected"'
                                    ?>
                                    >Conservative
                            </option>
                            <option value="2" <?php
                                    if($prospect[0]->prospect_willingness_id==2)
                                        echo 'selected="selected"'
                                    ?>
                                    >Moderate
                            </option>
                            <option  value="1" <?php
                                    if($prospect[0]->prospect_willingness_id==1)
                                        echo 'selected="selected"'
                                    ?>
                                    >Aggresive
                            </option>
                          </select>
                        </div>
                        <div class="modal-footer">
                        <input type="hidden" name="id_willingness" value="{{$prospect[0]->customer_id}}">
                        <input type="submit" class="btn btn-primary" data-inline="true" value="Submit">
                      </div>
                      </form>
                    </div>
                 </div>
            </div>
            <br><span class="card-customer-title-telp">{{$customerData->telp_no}}</span>
            
        </div>
        
        <div class="card-customer-body">
           
            <h4 class="card-title">Customer Notes :</h4>

            @foreach ($customerSchedule as $customerScheduleLoop)
                <p class="card-text">Notes {{$loop->iteration}} : {{$customerScheduleLoop ->notes}}</p>
            @endforeach
             <h4 class="card-title">Address :</h4>
            @foreach ($addressProspect as $addressProspectLoop)
           <p class="card-title">Address {{$loop->iteration}} </p> 
            <p class="card-text">Province : {{$addressProspectLoop->province}}</p>
            <p class="card-text">Village : {{$addressProspectLoop->kelurahan}}</p>
            <p class="card-text">City : {{$addressProspectLoop->city}}</p>
            <p class="card-text">Postal Code : {{$addressProspectLoop->postal_code}}</p>
            <p class="card-text">Sub-district : {{$addressProspectLoop->district}}</p>
           
                @endforeach
             <h3 class='card-title'>Product(s) :</h3>
             @foreach($kumpulanTemp as $keys => $productLoop)
                             @for($i = 0; $i < sizeof($productLoop['dataAmountProduct']); $i++)
                                <p class="card-text">{{$productLoop['dataTypeProduct'][$i]->desc}} : Rp.{{$productLoop['dataAmountProduct'][$i]->amount}} </p>
                                @if($productLoop['dataAppointment'][$i]->is_a_deal == 0)
                                <p>Produk ditambahkan pada tanggal {{$productLoop['dataAppointment'][$i]->created_at}} </p>
                                @else
                                <p style="color: red">Deal terjadi pada tanggal {{$productLoop['dataAppointment'][$i]->created_at}} </p>
                                @endif
                             @endfor
                            @endforeach 
            <p>{{$scheduleDeal[0]->id}}</p>
        </div>
    </div>
</div>

@endsection