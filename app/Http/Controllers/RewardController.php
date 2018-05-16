<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Rating;
use App\Salesperson;
use App\ProductType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DateTime;


class RewardController extends Controller
{
  public function compareSalesperson(){
    date_default_timezone_set("Asia/Bangkok");
    $date = date('d-m');
    $inputSls = '7'; //best performance Salesperson user id
    $inputProdAgr  = '1';//best performance ProductType id for Aggresif
    $inputProdMod  = '2';//best performance ProductType id  for Moderate
    $inputProdCons = '3';//best performance ProductType id for Conservative
    //add reward
    if($date == '13-05'){
        $currentYear = date("y");
        if(sizeof(Rating::All()) !== 0){
        $latestYear = substr((Rating::select('date')->orderBy('date','desc')->first()->date),2,2);
      }else{
        $latestYear = 0;
      }

      if($currentYear !== $latestYear ){

           $newReward = new Rating;
           $newReward->sales_user_id = $inputSls;
           $newReward->date = new DateTime();
           $newReward->save();

           $newReward = new Rating;
           $newReward->product_types_id = $inputProdAgr;
           $newReward->date = New DateTime();
           $newReward->save();

           $newReward = new Rating;
           $newReward->product_types_id = $inputProdMod;
           $newReward->date = New DateTime();
           $newReward->save();

           $newReward = new Rating;
           $newReward->product_types_id = $inputProdCons;
           $newReward->date = New DateTime();
           $newReward->save();
      }
    }


//set reward to UI======================================================================================
    $id = Auth::id();
    $user = User::find($id);
    $is_sp = User::select('is_sp')->where('id',$id)->get()->first()->is_sp;
//for salesperson view
    if($is_sp == 1){
      if((Rating::where('sales_user_id',$id)->get()->first()) !== null ){
        $amountRating =  Rating::where('sales_user_id',$id)->count();
        // return $amountRating; 
        return view('riwayat',compact('amountRating'));
      }else{
        $amountRating = 0;
        return view('riwayat',compact('amountRating'));
      }
    }
//for branch manager view
    else{
      $jml = sizeof(Rating::all());
      $listRatingSls = array();
      $listRatingProd = array();

      $ratings = Rating::all();
      foreach($ratings as $rating) {
        if (isset($rating -> sales_user_id)) {
        $nameSls = User::find($rating -> sales_user_id) -> name;
        $yearSls = substr($rating -> date, 0,4);
        $listRatingSls[] =  array('name' => $nameSls,'year'=> $yearSls );


      } else if (isset($rating -> product_types_id)) {
        $nameProd = ProductType::find($rating-> product_types_id) -> desc;
        $yearProd = substr($rating -> date, 0,4);
        $listRatingProd[] =  array('name' => $nameProd,'year'=> $yearProd );

        }
      }

      return view('dashboard',compact('listRatingProd','listRatingSls'));
    }



    //  {{$listRating[$i]['name']}}
    // {{$listRating[$i]['year']}} BUAT VIEW BRANCH MANAGER BUAT SP RATING
//=======================================================================================================

//

  }




  public function compareProduct(){
    $rewardedProduct = "reksadana ";
  }
}
