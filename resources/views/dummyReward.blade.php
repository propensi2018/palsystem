
@extends('layouts.master')
@section('title','Inbox')
@section('contents')



    @foreach ($listRatingSls as  $listRatingSls)
    {{$listRatingSls['name']}}
    {{$listRatingSls['year']}}
    @endforeach

    @foreach ($listRatingProd as  $listRatingProd)
    {{$listRatingProd['name']}}
    {{$listRatingProd['year']}}
    @endforeach

    @for ($i = 0; $i < $amountRating ; $i++)

        <a>*</a>

    @endfor



@endsection
