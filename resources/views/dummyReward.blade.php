
@extends('layouts.master')
@section('title','Inbox')
@section('contents')



@for ($i = 0; $i < $amountRating ; $i++)

    <a>*</a>
    {{$listRating[$i]['name']}}
    {{$listRating[$i]['year']}}
@endfor




@endsection
