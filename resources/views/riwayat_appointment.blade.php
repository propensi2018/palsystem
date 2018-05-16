
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
            <p >Time : {{$appointment->created_at}}</p>
            <p >Customer Name : {{$appointment->name}}</p>
            <p >Notes : {{$appointment->notes}}</p>
            <a href="../public/history" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
    

@endsection