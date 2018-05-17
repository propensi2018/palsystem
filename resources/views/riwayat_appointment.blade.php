
@extends('layouts.master')
@section('title','Call History')
@section('contents')


<div class="profile-customer">
    <ul class="nav nav-tabs nav-appt">
        <li id="tab-1" class="nav-item">
            <a id="nav-tulisan" id="navbar-active" class="nav-link nav-appt-active">APPOINTMENT HISTORY</a>
        </li>
        <li id="tab-2" class="nav-item">
        </li>
    </ul>
    <div class="card-customer">
        <div class="card-customer-body">
            @if (is_null($appointment))
                <p>Detail appointment ini baru dapat dilihat jika customer telah selesai melakukan pembelian</p>
            @else
                <p >Appointment Type : {{$appointment->activity_name}}</p>
                <p >Time : {{$appointment->created_at}}</p>
                <p >Customer Name : {{$appointment->customer_name}}</p>
                <p >Notes : {{$appointment->notes}}</p>
                @if (!$products->isEmpty())
                    Product : <br><br>
                    @foreach ($products as $product)
                        <p style="padding-left: 20px">Name : {{$product->desc}}</p>
                        <p style="padding-left: 20px">Amount : Rp. {{number_format($product->amount)}}</p> <br>
                    @endforeach
                @endif
            @endif
            
            <br>
            <a href="../public/history" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
    

@endsection