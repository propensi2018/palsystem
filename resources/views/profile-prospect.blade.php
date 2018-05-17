
@extends('layouts.master')
@section('title','Profile Customer')
@section('contents')



<div class="profile-customer">
    <ul class="nav nav-tabs nav-appt">
        <li id="tab-1" class="nav-item">
            <a id="nav-tulisan" id="navbar-active" class="nav-link nav-appt-active">CUSTOMER DATA</a>
        </li>
           @if(sizeof($allSchedule)!=0)
        <li id="tab-2" class="nav-item">
            <a id="nav-tulisan" class="nav-link nav-appt-no-active" href="{{ URL::to('../public/appointment/' . $customerData->id)}}">APPOINTMENT</a>
        </li>
            @else
            @endif
    </ul>
    <div class="card-customer">
        <div class="card-customer-title">
            <h1 class="card-customer-title-name">{{$customerData->name}}</h1> 
              @if(sizeof($allSchedule)!=0)              
                @else
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$customerData->id}}">Re-Approach</button>

                   <div class="modal fade" id="myModal{{$customerData->id}}">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">

                    <form method="post" action="customer/storeExistingCust" ng-controller="DateController as dateCtrl">  {{ csrf_field() }}

                      <div class="modal-header">
                        <h4 class="modal-title" style="color:black">Customer Response:</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;
                        </button>
                      </div>

                      <div class="modal-body" ng-app="dateInputExample">
                        <script>
                          angular.module('dateInputExample', []) .controller('DateController', ['$scope', function($scope) {
                            $scope.example = {
                            value: new Date(2015, 3, 22), currentDate: new Date()
                            };
                          }]);
                        </script>

                        <div class="row">
                          <div class="col-sm-6 col-md-6 col-md-offset-12">
                            <h6 style="color:black">Customer Responses<span><font color="red">* </font></span>:</h6>
                            <select id="customer_type" class="custom-select" name="customer_type">
                              <option value="Pending">Pending</option>
                              <option value="Reject">Reject</option>
                            </select>
                          </div>

                          <div class="col-sm-6 col-md-6 col-md-offset-12">
                            <h6 style="color:black" >Date<span><font color="red">* </font></span>:</h6>
                            <input type="hidden" name="id_customer" value="{{$customerData -> id}}">
                            <input name="time" id="time" type="datetime-local" min="{{$today}}" class="form-control" >
                          </div>
                        </div>
                        <br>
                        <h6 style="color:black">Notes:</h6>
                        <textarea type="text" class="form-control" rows="2" name="notes" id="notes" placeholder="write any response here.."></textarea><br>
                      </div>

                      <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" data-inline="true" value="Submit">
                      </div>
                        <input type="hidden" name="cycleCust" value="{{$prospect[0]->cycle}}">
                    </form>
                  </div>
                </div>
              </div>
                @endif
                @if($customerType->name === 'Hot')
                    <span class='badge badge-danger'>{{$customerType->name}}</span>
                @else
                    <span class='badge badge-success'>{{$customerType->name}}</span>
                @endif
            <span class="badge badge-secondary">{{$pw->name}}</span>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalWillingness">Change</button>
            <br>
             <div class="modal fade" id="modalWillingness">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form method="post" action="customer/willingnessResponse" >{{ csrf_field() }}
                        <div class="modal-header">
                        <h4 class="modal-title" style="color:black;">Change Prospect Willingness </h4>
                        </div>
                        <div class="modal-body">
                          <select id="prospect_willingness" class="custom-select col-8 col-sm-9" name="prospect_willingness">
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
            @foreach($telepon as $teleponLoop)
          <span class="card-customer-title-telp">{{$teleponLoop->telp_no}} / </span>
            @endforeach
        </div>
        </div>
        <div class="card-customer-body">
            <h4 class="card-title">Customer Notes :</h4>
            @foreach ($customerSchedule as $customerScheduleLoop)
                <p class="card-text">Notes {{$loop->iteration}} : {{$customerScheduleLoop ->notes}}</p>
            @endforeach
            @foreach ($addressProspect as $addressProspectLoop)
                <h4 class="card-title">Address {{$loop->iteration}} :</h4> 
                <p class="card-text">Province : {{$addressProspectLoop->province}}</p>
                <p class="card-text">Village : {{$addressProspectLoop->kelurahan}}</p>
                <p class="card-text">City : {{$addressProspectLoop->city}}</p>
                <p class="card-text">Postal Code : {{$addressProspectLoop->postal_code}}</p>
                <p class="card-text">Sub-district : {{$addressProspectLoop->district}}</p>
            @endforeach
                <h3 class='card-title'>Product(s) :</h3>
            @foreach($kumpulanTemp as $keys => $productLoop)
            @for($i=0; $i<sizeof($productLoop['dataTypeProduct']);$i++)
                <?php
                $tipeProduk = $productLoop['dataTypeProduct'][$i];
                $amountProduk = $productLoop['dataAmountProduct'][$i];
                ?>                                    
             @if(sizeof($scheduleDeal)!=0)
                <p class="card-text">{{$tipeProduk->desc}} : Rp.{{$amountProduk->amount}} </p>
                <p style="color: red">Deal terjadi pada tanggal {{$productLoop['dataAppointment'][0]->created_at}} </p>
             @else
                <p class="card-text">{{$tipeProduk->desc}} : Rp.{{$amountProduk->amount}} </p>
                <p style="color: blue">Customer tertarik dengan produk ini tertanggal {{$productLoop['dataAppointment'][0]->created_at}} </p>
            @endif  
            @endfor
            @endforeach 
        </div>
    </div>
@endsection