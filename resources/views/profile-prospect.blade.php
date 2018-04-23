
@extends('layouts.master')
@section('title','Profile Customer')
@section('contents')


<div class="profile-customer">
    <ul class="nav nav-tabs nav-appt">
        <li id="tab-1" class="nav-item">
            <a id="nav-tulisan" id="navbar-active" class="nav-link nav-appt-active">CUSTOMER DATA</a>
        </li>
        <li id="tab-2" class="nav-item">
            <a id="nav-tulisan" class="nav-link nav-appt-no-active" href="{{ URL::to('../public/appointment/' . $customerData->id)}}">APPOINTMENT</a>
        </li>
    </ul>
    <div class="card-customer">
        <div class="card-customer-title">
            <h1 class="card-customer-title-name">{{$customerData->name}}</h1>
            <span class="badge badge-secondary">{{$pw->name}}</span>
                @if($customerType->name === 'Hot')
                    <span class='badge badge-danger'>{{$customerType->name}}</span>
                @else
                    <span class='badge badge-success'>{{$customerType->name}}</span>
                @endif
            <br><span class="card-customer-title-telp">{{$customerData->telp_no}}</span>
        </div>
        <div class="card-customer-body">
            <h4 class="card-title">Customer Notes :</h4>

            @foreach ($customerSchedule as $customerScheduleLoop)
                <p class="card-text">Notes {{$loop->iteration}} : {{$customerScheduleLoop ->notes}}</p>
            @endforeach
            <h4 class="card-title">Address :</h4>
           
            <p class="card-text">Province : {{$prospectAddress->province}}</p>
            <p class="card-text">Village : {{$prospectAddress->kelurahan}}</p>
            <p class="card-text">City : {{$prospectAddress->city}}</p>
            <p class="card-text">Postal Code : {{$prospectAddress->postal_code}}</p>
            <p class="card-text">Sub-district : {{$prospectAddress->district}}</p>
            <h3 class='card-title'>Product(s) :</h3>
            
             @foreach($kumpulanTemp as $keys => $productLoop)
                             @for($i = 0; $i < sizeof($productLoop['dataAmountProduct']); $i++)
                                <p class="card-text">{{$productLoop['dataTypeProduct'][$i]->desc}} : Rp.{{$productLoop['dataAmountProduct'][$i]->amount}} </p>
                             @endfor
                            @endforeach       
        </div>
    </div>
</div>
    

@endsection