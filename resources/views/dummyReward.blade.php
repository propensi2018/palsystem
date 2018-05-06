
@extends('layouts.master')
@section('title','Inbox')
@section('contents')



@foreach ($nameSp as $nameUser)
  {{$nameUser}}
@endforeach

@endsection
