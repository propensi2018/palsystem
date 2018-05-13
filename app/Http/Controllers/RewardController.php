<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\MessageReceived;
use App\Rating;
use App\Message;
use App\Salesperson;
use App\Branch;
use App\Region;
use App\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\File;
use DateTime;


class RewardController extends Controller
{
  public function compareSalesperson(){
    date_default_timezone_set("Asia/Bangkok");
    $date = date('d-m');
    $input = '6'; //best performance Salesperson user id

    //add reward
    if($date == '12-05'){
        $currentYear = date("y");

        if(sizeof(Rating::All()) !== 0){
        $latestYear = substr((Rating::select('date')->orderBy('date','desc')->first()->date),2,2);
      }else{
        $latestYear = 0;
      }

      if($currentYear !== $latestYear ){
        if((Rating::select('score')->where('sales_user_id',$input)->get()->first()) == null){
          $newReward = new Rating;
          $newReward->sales_user_id = $input;
          $newReward->date = new DateTime();
          $newReward->score = 1;
          $newReward->save();
        }
        else{
           $currentScore = Rating::select('score')->where('sales_user_id',$input)->get()->first()->score;
           $newReward = new Rating;
           $newReward->sales_user_id = $input;
           $newReward->date = new DateTime();
           $newReward->score = $currentScore+1;
           $newReward->save();
        }
      }
    }
//set reward to UI======================================================================================
    $id = Auth::id();
    $user = User::find($id);
    $is_sp = User::select('is_sp')->where('id',$id)->get()->first()->is_sp;

    if($is_sp == 1){
      if((Rating::where('sales_user_id',$id)->get()->first()) !== null ){
        $amountRating =  Rating::where('sales_user_id',$id)->count();
        return view('dummyReward',compact('amountRating'));

      }else{
        $amountRating = 0;
        return view('dummyReward',compact('amountRating'));
      }
    }else{
      $jml = sizeof(Rating::all());
      $listRating = array();

      for($i=0; $i< $jml; $i++){
        $idSls = Rating::select('sales_user_id')->where('id',$i+1)->get()->first()->sales_user_id;
        $nameSls = User::find($idSls)->name;
        $year = substr((Rating::select('date')->where('id',$i+1)->get()->first()->date),0,4);
        $listRating[] =  array('name' => $nameSls,'year'=> $year );
      }
       $amountRating = $jml;

      return view('dummyReward',compact('amountRating','listRating'));
    }


//=======================================================================================================

//

  }




  public function compareProduct(){
    $rewardedProduct = "reksadana ";
  }
}
