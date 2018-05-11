
@extends('layouts.master')
@section('title','Inbox')
@section('contents')



@for ($i = 0; $i < $amountRating ; $i++)
    <a>*</a>
@endfor



@endsection
