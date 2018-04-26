@extends('layouts.master')

@section('title', 'Unique Code')

@section('contents')

<div id="uc" align="center">
    <form>
        <p id="pUC">Kode : {{$transaction['code']}} </p>
        <input type="hidden" value='{{$id_customer}}'>

        <input id="iUC" type="button" class="btn" value="Return" onclick="window.location.href='../public/customer/{{$id_customer}}'" />
    </form>
</div>

@endsection
